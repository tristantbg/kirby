<?php

namespace Kirby\Section;

use Kirby\Blueprint\Autoload;
use Kirby\Blueprint\Extension;
use Kirby\Foundation\NodeWithType;

/**
 * Section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Section extends NodeWithType
{
	public const TYPE = 'section';

	public function __construct(
		public string $id,
		public Extension|null $extends = null,
	) {

	}

	public static function load(string|array $props): static
	{
		return Autoload::section($props);
	}

	public static function polyfill(array $props): array
	{
		$props = parent::polyfill($props);

		// convert old headlines to labels
		if (isset($props['headline']) === true) {
			$props['label'] ??= $props['headline'] ?? null;
			unset($props['headline']);
		}

		return $props;
	}
}
