<?php

namespace Kirby\Value;

/**
 * Array Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ArrayValue extends Value
{
	public function __construct(
		public int|null $max = null,
		public int|null $min = null,
		public array|null $data = null,
		...$args
	) {
		parent::__construct(...$args);

		$this->validations->add('max', $this->max);
		$this->validations->add('min', $this->min);
	}

	public function __toString(): string
	{
		return serialize($this->data);
	}

	public function isEmpty(): bool
	{
		return $this->data === null || $this->data === [];
	}

	public function set(array|null $data = null): static
	{
		$this->data = $data;
		return $this;
	}
}
