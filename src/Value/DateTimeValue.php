<?php

namespace Kirby\Value;

use Kirby\Toolkit\Date;

/**
 * Datetime Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class DateTimeValue extends Value
{
	public function __construct(
		public Date|null $data = null,
		...$args
	) {
		parent::__construct(...$args);
	}

	public function __toString(): string
	{
		return $this->data?->format('Y-m-d H:i:s');
	}

	public function set(string|int|null $data = null): static
	{
		$this->data = Date::optional($data);
		return $this;
	}
}
