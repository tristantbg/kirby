<?php

namespace Kirby\Value;

/**
 * Bool Value
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BoolValue extends Value
{
	public function __construct(
		public bool|null $data = null,
		...$args
	) {
		parent::__construct(...$args);
	}

	public function set(bool|string|int|null $data = null): static
	{
		// empty
		if ($data === null || $data === '') {
			$this->data = $data;

		// already a bool
		} elseif ($data === false || $data === true) {
			$this->data = $data;

		// interpretable values
		} else {
			$this->data = match (strtolower($data)) {
				// valid true states
				'1', 'on', 'true', 'yes' => true,

				// false by default
				default => false
			};
		}

		return $this;
	}

	public function isEmpty(): bool
	{
		return $this->data === null;
	}
}
