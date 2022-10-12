<?php

namespace Kirby\Form;

use Closure;
use Kirby\Cms\App;
use Kirby\Toolkit\Collection;
use Throwable;

/**
 * A collection of Field objects
 *
 * @package   Kirby Form
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Fields extends Collection
{
	/**
	 * Internal setter for each object in the Collection.
	 * This takes care of validation and of setting
	 * the collection prop on each object correctly.
	 *
	 * @param string $name
	 * @param object|array $field
	 * @return void
	 */
	public function __set(string $name, $field): void
	{
		if (is_array($field) === true) {
			// use the array key as name if the name is not set
			$field['name'] ??= $name;
			$field = Field::factory($field['type'], $field, $this);
		}

		parent::__set($field->name(), $field);
	}

	/**
	 * Creates a new fieldset
	 */
	public static function factory(array $fields = []): static
	{
		$collection = new static;

		foreach ($fields as $name => $props) {
			// inject the name
			$props['name'] = $name = strtolower($name);

			try {
				$field = Field::factory($props['type'], $props, $collection);
			} catch (Throwable $e) {
				$field = Field::exception($e, $props);
			}

			$collection->append($name, $field);
		}

		return $collection;
	}

	/**
	 * Disables fields in secondary languages when
	 * they are configured to be untranslatable
	 */
	public static function prepareForLanguage(array $fields, string|null $language = null): array
	{
		$kirby = App::instance(null, true);

		// only modify the fields if we have a valid Kirby multilang instance
		if (!$kirby || $kirby->multilang() === false) {
			return $fields;
		}

		// get the current language
		$language ??= $kirby->language()->code();

		// nothing happens for the default language
		if ($language === $kirby->defaultLanguage()->code()) {
			return $fields;
		}

		return array_map(function ($field) {
			// switch untranslatable fields to readonly
			if (($field['translate'] ?? true) === false) {
				$field['unset']    = true;
				$field['disabled'] = true;
			}

			return $field;
		}, $fields);
	}

	/**
	 * Converts the fields collection to an
	 * array and also does that for every
	 * included field.
	 *
	 * @param \Closure|null $map
	 * @return array
	 */
	public function toArray(Closure $map = null): array
	{
		$array = [];

		foreach ($this as $field) {
			$array[$field->name()] = $field->toArray();
		}

		return $array;
	}
}
