<?php

namespace Kirby\Section;

use Kirby\Node\FeatureNode;
use Kirby\Node\LabelledNode;

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
		$props = LabelledNode::polyfillHeadline($props);
		$props = parent::polyfill($props);

		return $props;
	}
}
