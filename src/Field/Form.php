<?php

namespace Kirby\Field;

use Kirby\Blueprint\Factory;
use Kirby\Cms\ModelWithContent;
use Kirby\Value\Values;

/**
 * Form
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Form
{
	public function __construct(
		public Fields $fields,
	) {
	}

	public static function factory(array $props): ?static
	{
		$props = Factory::apply($props, [
			'fields' => Fields::class
		]);

		return new static(...$props);
	}

	public function fill(array $values = [], bool $defaults = false): static
	{
		$this->fields->fill($values, $defaults);
		return $this;
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'fields' => $this->fields->render($model)
		];
	}

	public function submit(array $values = []): static
	{
		$this->fields->active()->submit($values);
		return $this;
	}

	public function values(): Values
	{
		return $this->fields->active()->export();
	}
}
