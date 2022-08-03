<?php

namespace Kirby\Section;

use Kirby\Foundation\Feature;

/**
 * Section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Section extends Feature
{
	public const GROUP = 'section';
	public const TYPE  = 'section';

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
