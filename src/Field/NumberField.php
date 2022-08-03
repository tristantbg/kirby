<?php

namespace Kirby\Field;

use Kirby\Attribute\IconAttribute;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Prop\After;
use Kirby\Field\Prop\Before;
use Kirby\Field\Prop\Placeholder;
use Kirby\Value\NumberValue;

/**
 * Number field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NumberField extends InputField
{
	public const TYPE = 'number';
	public NumberValue $value;

	public function __construct(
		public string $id,
		public After|null $after = null,
		public string|null $autocomplete = null,
		public Before|null $before = null,
		public int|float|null $default = null,
		public IconAttribute|null $icon = null,
		public int|float|null $max = null,
		public int|float|null $min = null,
		public Placeholder|null $placeholder = null,
		public int|float|null $step = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new NumberValue(
			max:      $this->max,
			min: 	  $this->min,
			required: $this->required
		);
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'after'        => $this->after?->render($model),
			'autocomplete' => $this->autocomplete,
			'before'       => $this->before?->render($model),
			'icon'         => $this->icon?->render($model),
			'max'          => $this->max,
			'min'          => $this->min,
			'placeholder'  => $this->placeholder?->render($model),
			'step'         => $this->step,
		];
	}
}
