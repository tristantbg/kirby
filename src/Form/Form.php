<?php

namespace Kirby\Form;

use Closure;
use Kirby\Cms\App;
use Kirby\Cms\Model;
use Kirby\Data\Data;
use Kirby\Exception\NotFoundException;
use Kirby\Toolkit\Str;
use Throwable;

/**
 * The main form class, that is being
 * used to create a list of form fields
 * and handles global form validation
 * and submission
 *
 * @package   Kirby Form
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Form
{
	/**
	 * An array of all found errors
	 */
	protected array|null $errors = null;

	/**
	 * Fields in the form
	 */
	protected Fields $fields;

	/**
	 * The parent model for all fields
	 */
	protected Model $model;

	/**
	 * Strict value handling will ignore
	 * input from non-existing fields
	 */
	protected bool $strict = false;

	/**
	 * All values of the form
	 */
	protected array $values = [];

	/**
	 * Form constructor
	 */
	public function __construct(array $props)
	{
		$this->model  = $props['model']  ?? null;
		$this->strict = $props['strict'] ?? false;

		// prepare field properties for multilang setups
		$fields = Fields::prepareForLanguage(
			$props['fields'] ?? [],
			$props['language'] ?? null
		);

		// add the model to every field
		$fields = array_map(function(array $field): array {
			$field['model'] ??= $this->model;
			return $field;
		}, $fields);

		$this->fields = Fields::factory($fields);

		// pre-fill the form
		if (empty($props['values']) === false) {
			$this->fill($props['values'], true);
		}

		// fill in additional input from a request
		if (empty($props['input']) === false) {
			$this->fill($props['input']);
		}
	}

	/**
	 * Returns the data required to write to the content file
	 * Doesn't include default and null values
	 */
	public function content(): array
	{
		return $this->data(false, false);
	}

	/**
	 * Returns data for all fields in the form
	 */
	public function data($defaults = false, bool $includeNulls = true): array
	{
		$data = $this->values;

		foreach ($this->fields as $field) {
			if ($field->save() === false || $field->unset() === true) {
				if ($includeNulls === true) {
					$data[$field->name()] = null;
				} else {
					unset($data[$field->name()]);
				}
			} else {
				$data[$field->name()] = $field->data($defaults);
			}
		}

		return $data;
	}

	/**
	 * An array of all found errors
	 */
	public function errors(): array
	{
		if ($this->errors !== null) {
			return $this->errors;
		}

		$this->errors = [];

		foreach ($this->fields as $field) {
			if (empty($field->errors()) === false) {
				$this->errors[$field->name()] = [
					'label'   => $field->label(),
					'message' => $field->errors()
				];
			}
		}

		return $this->errors;
	}

	/**
	 * Shows the error with the field
	 *
	 * @deprecated 3.9.0 Use \Kirby\Form\Field::exception instead
	 */
	public static function exceptionField(Throwable $exception, array $props = [])
	{
		return Field::exception($exception, $props);
	}

	/**
	 * Get the field object by name
	 * and handle nested fields correctly
	 *
	 * @throws \Kirby\Exception\NotFoundException
	 */
	public function field(string $name): Field
	{
		$form       = $this;
		$fieldNames = Str::split($name, '+');
		$index      = 0;
		$count      = count($fieldNames);
		$field      = null;

		foreach ($fieldNames as $fieldName) {
			$index++;

			if ($field = $form->fields()->get($fieldName)) {
				if ($count !== $index) {
					$form = $field->form();
				}
			} else {
				throw new NotFoundException('The field "' . $fieldName . '" could not be found');
			}
		}

		// it can get this error only if $name is an empty string as $name = ''
		if ($field === null) {
			throw new NotFoundException('No field could be loaded');
		}

		return $field;
	}

	/**
	 * Returns all form fields
	 */
	public function fields(): Fields
	{
		return $this->fields;
	}

	/**
	 * Adds values to the form
	 */
	public function fill(array $input, bool $force = false): static
	{
		// reset the errors cache
		$this->errors = null;

		$input = array_change_key_case($input);

		foreach ($this->fields as $name => $field) {
			if (isset($input[$name]) === true) {
				$field->fill($input[$name], $force);
			}

			if ($field->save() !== false) {
				$this->values[$name] = $field->value();
			}
		}

		if ($this->strict === true) {
			return $this;
		}

		foreach ($input as $key => $value) {
			if (isset($this->values[$key]) === false) {
				$this->values[$key] = $value;
			}
		}

		return $this;
	}

	/**
	 * Creates a form instance for the model
	 */
	public static function for(Model $model, array $props = []): static
	{
		// get the original model data
		$original = $model->content($props['language'] ?? null)->toArray();
		$values   = $props['values'] ?? [];

		// convert closures to values
		foreach ($values as $key => $value) {
			if ($value instanceof Closure) {
				$values[$key] = $value($original[$key] ?? null);
			}
		}

		// set a few defaults
		$props['values']   = array_merge($original, $values);
		$props['fields'] ??= [];
		$props['model']    = $model;

		// search for the blueprint
		if (method_exists($model, 'blueprint') === true && $blueprint = $model->blueprint()) {
			$props['fields'] = $blueprint->fields();
		}

		$ignoreDisabled = $props['ignoreDisabled'] ?? false;

		// REFACTOR: this could be more elegant
		if ($ignoreDisabled === true) {
			$props['fields'] = array_map(function ($field) {
				$field['disabled'] = false;
				return $field;
			}, $props['fields']);
		}

		return new static($props);
	}

	/**
	 * Checks if the form is invalid
	 */
	public function isInvalid(): bool
	{
		return empty($this->errors()) === false;
	}

	/**
	 * Checks if the form is valid
	 */
	public function isValid(): bool
	{
		return empty($this->errors()) === true;
	}

	/**
	 * Disables fields in secondary languages when
	 * they are configured to be untranslatable
	 *
	 * @deprecated 3.9.0 Use Fields::prepareForLanguage instead
	 */
	protected static function prepareFieldsForLanguage(array $fields, string|null $language = null): array
	{
		return Fields::prepareForLanguage($fields, $language);
	}

	/**
	 * Converts the data of fields to strings
	 */
	public function strings($defaults = false): array
	{
		$strings = [];

		foreach ($this->data($defaults) as $key => $value) {
			if ($value === null) {
				$strings[$key] = null;
			} elseif (is_array($value) === true) {
				$strings[$key] = Data::encode($value, 'yaml');
			} else {
				$strings[$key] = $value;
			}
		}

		return $strings;
	}

	/**
	 * Converts the form to a plain array
	 */
	public function toArray(): array
	{
		$array = [
			'errors'  => $this->errors(),
			'fields'  => $this->fields->toArray(fn ($item) => $item->toArray()),
			'invalid' => $this->isInvalid()
		];

		return $array;
	}

	/**
	 * Returns form values
	 */
	public function values(): array
	{
		return $this->values;
	}
}
