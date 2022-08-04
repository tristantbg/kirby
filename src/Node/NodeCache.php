<?php

namespace Kirby\Node;

/**
 * Node Cache
 *
 * @package   Kirby Node
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeCache
{
	public static array $cache = [];

	public function get(string $cacheId): ?Node
	{
		return static::$cache[$cacheId] ?? null;
	}

	public function set(string $cacheId, Node $node): Node
	{
		return static::$cache[$cacheId] = $node;
	}
}
