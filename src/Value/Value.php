<?php

namespace Kirby\Value;

use Kirby\Blueprint\Factory;
use Kirby\Validation\Validations;

/**
 * Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
abstract class Value implements Factory
{
	public Validations $validations;

	public function __construct(
		public bool $required = false
	) {
		$this->validations = new Validations;
		$this->validations->add('required', $this->required);
	}

	public function __toString(): string
	{
		return (string)$this->data;
	}

	public function errors(): array
	{
		return $this->validations()->errors($this->data);
	}

	public static function factory($data = null): static
	{
		return (new static)->set($data);
	}

	public function isEmpty(): bool
	{
		return $this->data === null;
	}

	abstract public function set(): static;

	public function submit(mixed $data = null): static
	{
		$clone = clone $this;
		$clone->set($data);
		$clone->validate();

		$this->data = $clone->data;

		return $this;
	}

	public function validate(): bool
	{
		return $this->validations()->validate($this->data);
	}

	public function validations(): Validations
	{
		$this->validations ??= new Validations;

		// only validate the required state when the value is empty
		if ($this->isEmpty() === true) {
			return $this->validations->only('required');
		}

		return $this->validations;
	}

}
