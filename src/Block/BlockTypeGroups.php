<?php

namespace Kirby\Block;

use Kirby\Cms\App;
use Kirby\Exception\LogicException;
use Kirby\Foundation\Extension;
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

	public static function default(): static
	{
		$options = App::instance()->options();
		$types   = $options['blocks.types'] ?? $options['blocks.fieldsets'] ?? [
			'blocks/code',
			'blocks/gallery',
			'blocks/heading',
			'blocks/image',
			'blocks/line',
			'blocks/list',
			'blocks/markdown',
			'blocks/quote',
			'blocks/text',
			'blocks/video',
		];

		return static::factory($types);
	}

	/**
	 * The factory has a special job because
	 * in a blueprint, the blocks can be either
	 * defined directly without a wrapping group
	 * or by a set of groups. The factory needs
	 * to make sure it detects groups and block types
	 * correctly and wraps lose block types in a
	 * generic group
	 */
	public static function factory(array $nodes): static
	{
		$types  = new BlockTypes;
		$groups = new BlockTypeGroups;

		foreach ($nodes as $id => $props) {
			$node       = static::nodeFactory($id, $props);
			$collection = is_a($node, BlockType::class) === true ? $types : $groups;

			// add the node to the correct collection
			$collection->__set($node->id, $node);
		}

		// When there are no lose types
		// the groups collection can
		// be returned without further checks
		if ($types->count() === 0) {
			return $groups;
		}

		// mixing groups and types is not supported.
		// resolving them properly would be too complex
		if ($groups->count() !== 0) {
			throw new LogicException('Mixing block types and block groups is not supported');
		}

		// lose types need to be joined in a new
		// generic group
		$group = new BlockTypeGroup(
			id: 'blocks',
			types: $types
		);

		// … and then added to the groups collection
		$groups->__set($group->id, $group);

		return $groups;
	}

	/**
	 * The node factory will load all props for a group
	 * or block type first to check which one it is afterwards.
	 *
	 * It will then call the matching load method and return the
	 * full instance. static::factory will take over and sort
	 * them into a BlockTypes and a BlockTypeGroups collection.
	 */
	public static function nodeFactoryByArray(string|int $id, array $props): BlockType|BlockTypeGroup
	{
		$props['id'] ??= $id;

		// fix old extension paths
		if (isset($props['extends']) === true) {
			$props['extends'] = BlockType::polyfillPath($props['extends']);
		}

		// already resolve an extension to get the full set of props
		// otherwise it will be really hard to tell if it is a block type or a group
		$props = Extension::apply($props);

		// it's a block type and not a block type group
		if (isset($props['fields']) === true || isset($props['name']) === true || isset($props['preview']) === true) {
			return BlockType::load($props);
		}

		return BlockTypeGroup::load($props);
	}
}
