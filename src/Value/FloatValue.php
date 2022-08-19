<?php

namespace Kirby\Value;

/**
 * Float Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FloatValue extends NumberValue
{
	public function get(): ?float
	{
		return $this->data;
	}

	public function set(string|float|int|null $data = null): static
	{
		if (is_string($data) === true) {
			if (is_numeric($data) === false) {
				$data = null;
			} else {
				$data = (float)$data;
			}
		}

		$this->data = $data;
		return $this;
	}
}
