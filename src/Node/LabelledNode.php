<?php

namespace Kirby\Node;

use Kirby\Attribute\LabelAttribute;

/**
 * Labelled Node
 *
 * @package   Kirby Node
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class LabelledNode extends Node
{
	public function __construct(
		public string $id,
		public LabelAttribute|null $label = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function label(): LabelAttribute
	{
		return $this->label ?? LabelAttribute::fallback($this->id);
	}

	public static function polyfillHeadline(array $props): array
	{
		if (isset($props['headline']) === true) {
			$props['label'] ??= $props['headline'];
			unset($props['headline']);
		}

		return $props;
	}

	public static function polyfillTitle(array $props): array
	{
		if (isset($props['title']) === true) {
			$props['label'] ??= $props['title'];
			unset($props['title']);
		}

		return $props;
	}

}
