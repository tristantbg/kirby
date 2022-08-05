<?php

namespace Kirby\Value;

/**
 * String Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class StringValue extends Value
{
	public function __construct(
		public string|null $data = null,
		public int|null $maxlength = null,
		public int|null $minlength = null,
		public string|null $pattern = null,
		...$args
	) {
		parent::__construct(...$args);

		$this->validations->add('maxlength', $this->maxlength);
		$this->validations->add('minlength', $this->minlength);
		$this->validations->add('match', $this->pattern);
	}

	public function isEmpty(): bool
	{
		return $this->data === null || $this->data === '';
	}

	public function set(string|null $data = null): static
	{
		$this->data = $data;
		return $this;
	}

}
