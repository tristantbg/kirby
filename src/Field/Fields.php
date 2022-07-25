<?php

namespace Kirby\Field;

use Kirby\Blueprint\Autoload;
use Kirby\Foundation\Collection;
use Kirby\Value\Value;
use Kirby\Value\Values;
use Throwable;

/**
 * Fields
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Fields extends Collection
{
	public const TYPE = Field::class;

	public function disable(bool $disable = true)
	{
		foreach ($this->data as $field) {
			$field->disabled = $disable;
		}

		return $this;
	}

	public static function factory(array $fields = []): static
	{
		$collection = new static();
		$collection->data = Autoload::collection('field', $fields);

		return $collection;
	}

	public function fill(array $values = [], bool $defaults = false): static
	{
		foreach ($this->inputs() as $id => $field) {
			if ($defaults === true && property_exists($field, 'default') === true) {
				$default = $field->default;
			} else {
				$default = null;
			}

			$field->fill($values[$id] ?? $default);
		}

		return $this;
	}

	public function inputs(): static
	{
		return $this->filter(function ($field) {
			return property_exists($field, 'value') && is_a($field->value, Value::class) === true;
		});
	}

	public function submit(array $values = []): static
	{
		foreach ($this->data as $field) {
			$field->submit($values[$field->id] ?? null);
		}

		return $this;
	}

	public function toValues(): Values
	{
		$values = new Values;

		foreach ($this->inputs() as $field) {
			if ($field->disabled === false) {
				$values->__set($field->id, $field->value);
			}
		}

		return $values;
	}

	public function untranslated(): static
	{
		return $this->inputs()->filter('translate', false);
	}
}
