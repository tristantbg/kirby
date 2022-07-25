<?php

namespace Kirby\Value;

use Kirby\Toolkit\Str;

/**
 * Slug Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class SlugValue extends StringValue
{
	public function __construct(
		public string|null $allowed = null,
		public string|null $separator = null,
		...$args
	) {
		parent::__construct(...$args);
	}

	public function set(string|null $data = null): static
	{
		$this->data = Str::slug($data, $this->separator, $this->allowed);
		return $this;
	}
}
