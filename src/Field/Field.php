<?php

namespace Kirby\Field;

use Kirby\Blueprint\Prop\Width;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Prop\When;
use Kirby\Foundation\NodeWithType;
use Kirby\Value\Value;

/**
 * Base field class
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Field extends NodeWithType
{
	public const TYPE = 'field';

	public function __construct(
		public string $id,
		public When|null $when = null,
		public Width|null $width = null,
	) {
	}

	public function fill(mixed $value = null): static
	{
		return $this;
	}

	public function submit(mixed $value = null): static
	{
		return $this;
	}
}
