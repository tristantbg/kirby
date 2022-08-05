<?php

namespace Kirby\Field;

use Kirby\Blueprint\Nodes;
use Kirby\Value\Values;

/**
 * Fields
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Fields extends Nodes
{
	public const TYPE = Field::class;

	public function active(): static
	{
		// get all inputs and ignore display fields
		$inputs = $this->inputs();

		// get all values for all fields
		$values = $inputs->export()->toArray();

		// filter disabled fields and fields
		// with conditions that are currently invisible
		return $inputs->filter(fn ($field) => $field->isActive($values));
	}

	public function disable(bool $disable = true)
	{
		foreach ($this->data as $field) {
			$field->disabled = $disable;
		}

		return $this;
	}

	public function export(): Values
	{
		$values = new Values;

		foreach ($this->inputs() as $field) {
			$values->__set($field->id, $field->value);
		}

		return $values;
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
		return $this->filter(fn ($field) => $field->isInput());
	}

	public static function nodeFactoryById(string|int $id): Field
	{
		return static::nodeFactoryByArray($id, [
			'id'   => $id,
			'type' => $id
		]);
	}

	public function submit(array $values = []): static
	{
		foreach ($this->inputs() as $field) {
			$field->submit($values[$field->id] ?? null);
		}

		return $this;
	}

	public function untranslated(): static
	{
		return $this->inputs()->filter('translate', false);
	}
}
