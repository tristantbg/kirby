<?php

namespace Kirby\Section;

use Kirby\Foundation\Polyfill;
use Kirby\Node\FeatureNode;

/**
 * Section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Section extends FeatureNode
{
	public const GROUP = 'section';
	public const TYPE  = 'section';

	public static function polyfill(array $props): array
	{
		$props = Polyfill::headline($props);
		$props = parent::polyfill($props);

		return $props;
	}
}
