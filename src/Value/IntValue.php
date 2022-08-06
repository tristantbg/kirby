<?php

namespace Kirby\Value;

/**
 * Int Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class IntValue extends NumberValue
{
	public function set(string|int|float|null $data = null): static
	{
		if (is_string($data) === true) {
			if (is_numeric($data) === false) {
				$data = null;
			} else {
				$data = (int)$data;
			}
		}

		$this->data = $data;
		return $this;
	}
}
