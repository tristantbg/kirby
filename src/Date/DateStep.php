<?php

namespace Kirby\Date;

/**
 * Date step
 *
 * @package   Kirby Date
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class DateStep
{
	public function __construct(
		public int $size = 1,
		public string $unit = 'day',
	) {
	}

	public static function factory(string|array|null $step = null): ?static
	{
		if ($step === null) {
			return null;
		}

		if (is_string($step) === true) {
			return new static(unit: $step);
		}

		return new static(...$step);
	}

	public function render(): array
	{
		return [
			'size' => $this->size,
			'unit' => $this->unit
		];
	}
}
