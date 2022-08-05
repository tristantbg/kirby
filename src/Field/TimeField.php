<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Date\TimeNotation;
use Kirby\Date\TimeStep;
use Kirby\Value\TimeValue;

/**
 * Date field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TimeField extends InputField
{
	public const TYPE = 'time';
	public TimeValue $date;

	public function __construct(
		public string $id,
		public string|null $default = null,
		public string|null $display = null,
		public string|null $format = 'H:i:s',
		public FieldIcon|null $icon = null,
		public TimeFieldNotation|null $notation = null,
		public string|null $max = null,
		public string|null $min = null,
		public TimeFieldStep|null $step = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new TimeValue(
			max: $this->max,
			min: $this->min,
			required: $this->required,
		);
	}

	public function defaults(): void
	{
		$this->icon     ??= new FieldIcon('clock');
		$this->notation ??= new TimeFieldNotation;
		$this->step     ??= new TimeFieldStep;
		$this->display  ??= $this->notation->display();
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'display'      => $this->display,
			'icon'         => $this->icon?->render($model),
			'notation'     => $this->notation?->value,
			'max'          => $this->max,
			'min'          => $this->min,
			'step'         => $this->step?->render($model),
		];
	}

}
