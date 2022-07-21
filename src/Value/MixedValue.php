<?php

namespace Kirby\Value;

use Kirby\Data\Yaml;

/**
 * Mixed Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class MixedValue extends Value
{
	public function __construct(
		public mixed $data = null,
		...$args
	) {
		parent::__construct(...$args);
	}

	public function __toString(): string
	{
		if (is_array($this->data) === true) {
			return Yaml::encode($this->data);
		}

		if (is_object($this->data) === true) {
			if (method_exists($this->data, '__toString') === true) {
				return $this->data->__toString();
			}

			return serialize($this->data);
		}

		return (string)$this->data;
	}

	public function set(mixed $data = null): static
	{
		$this->data = $data;
		return $this;
	}
}
