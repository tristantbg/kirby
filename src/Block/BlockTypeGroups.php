<?php

namespace Kirby\Block;

use Kirby\Blueprint\Extension;
use Kirby\Foundation\Node;
use Kirby\Foundation\Nodes;

/**
 * Block type groups
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlockTypeGroups extends Nodes
{
	public const TYPE = BlockTypeGroup::class;

	public static function factory(array $nodes): static
	{
		foreach ($nodes as $id => $props) {
			$node = match (true) {
				$props === true
					=> static::nodeFactoryById($id),

				is_string($props)
					=> static::nodeFactoryByString($id, $props),

				default
					=> static::nodeFactory($id, $props)
			};
		}
	}

	public static function nodeFactory(string|int $id, array $props): Node
	{
		$props['id'] ??= $id;

		// fix old extension paths
		if (isset($props['extends']) === true) {
			$props['extends'] = BlockType::polyfillPath($props['extends']);
		}

		$props = Extension::apply($props);

		dump($props);
		exit;

		// it's a block type and not a block type group
		if (isset($props['fields']) === true || isset($props['name']) === true || isset($props['preview']) === true) {
			return BlockType::load($props);
		}

		return BlockTypeGroup::load($props);
	}
}
