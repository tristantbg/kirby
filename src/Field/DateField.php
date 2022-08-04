<?php

namespace Kirby\Field;

use Kirby\Attribute\IconAttribute;
use Kirby\Cms\ModelWithContent;
use Kirby\Date\DateStep;
use Kirby\Value\DateTimeValue;

/**
 * Date field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class DateField extends InputField
{
	public const TYPE = 'date';
	public DateTimeValue $date;

	public function __construct(
		public string $id,
		public bool $calendar = true,
		public string|null $default = null,
		public string|null $display = null,
		public string|null $format = 'Y-m-d H:i:s',
		public IconAttribute|null $icon = null,
		public string|null $max = null,
		public string|null $min = null,
		public DateStep|null $step = null,
		public $time = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new DateTimeValue(
			max: $this->max,
			min: $this->min,
			required: $this->required,
		);
	}

	public function display(): string
	{
		return $this->display ?? 'YYYY-MM-DD';
	}

	public function icon(): IconAttribute
	{
		return $this->icon ?? new IconAttribute('calendar');
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'display' => $this->display(),
			'icon'    => $this->icon()->render($model),
			'max'     => $this->max,
			'min'     => $this->min,
			'step'    => $this->step()->render($model),
		];
	}

	public function step(): DateStep
	{
		return $this->step ?? new DateStep;
	}
}
