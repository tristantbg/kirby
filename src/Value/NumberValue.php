<?php

namespace Kirby\Value;

/**
 * Number Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NumberValue extends Value
{
	public function __construct(
		public int|null $max = null,
		public int|null $min = null,
		public int|float|null $data = null,
		...$args
	) {
		parent::__construct(...$args);

		$this->validations->add('max', $this->max);
		$this->validations->add('min', $this->min);
	}

	public function set(string|int|float|null $data = null): static
	{
		if (is_string($data) === true) {
			$data = match (true) {
				// not numeric at all
				is_numeric($data) === false => null,

				// could be a float
				str_contains($data, '.') === true => (float)$data,

				// should be an int
				default => (int)$data
			};
		}

		$this->data = $data;
		return $this;
	}
}
