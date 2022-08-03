<?php

namespace Kirby\Enumeration;

use Kirby\Cms\ModelWithContent;
use Kirby\Exception\InvalidArgumentException;

/**
 * Enumeration
 *
 * @package   Kirby Enumeration
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

	/**
	 * Creates an instance for the given value
	 */
	public static function factory(mixed $value): static
	{
		return new static($value);
	}

	public function render(ModelWithContent $model): mixed
	{
		return $this->value;
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
