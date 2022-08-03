<?php

namespace Kirby\Block;

use Kirby\Foundation\Nodes;

/**
 * Block types
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlockTypes extends Nodes
{
	public const TYPE = BlockType::class;

	public static function nodeFactory(string|int $id, array $props): BlockType
	{
		$props['id'] ??= $id;
		return BlockType::load($props);
	}
}
