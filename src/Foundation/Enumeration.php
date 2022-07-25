<?php

namespace Kirby\Foundation;

use Kirby\Exception\InvalidArgumentException;

/**
 * Enumeration
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
abstract class Enumeration
{
	public array $allowed = [];
	public mixed $default = null;

	public function __construct(
		public mixed $value = null,
	) {
		$this->set($value);
	}

	public function set(mixed $value): static
	{
		$value ??= $this->default;

		if (in_array($value, $this->allowed, true) === false) {
			throw new InvalidArgumentException('The given value "' . $value . '" is not allowed. Allowed values: ' . implode(', ', $this->allowed));
		}

		$this->value = $value;
		return $this;
	}
}
