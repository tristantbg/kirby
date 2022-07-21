<?php

namespace Kirby\Value;

/**
 * Json Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class JsonValue extends ArrayValue
{
	public function __construct(
		public bool $pretty = true,
		...$args
	) {
		parent::__construct(...$args);
	}

	public function __toString(): string
	{
		if ($this->pretty === true) {
			return json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		}

		return json_encode($this->data);
	}

	public function set(string|array|null $data = null): static
	{
		if (is_string($data) === true) {
			$data = json_decode($data, true);
		}

		$this->data = $data;
		return $this;
	}
}
