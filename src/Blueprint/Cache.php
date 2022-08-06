<?php

namespace Kirby\Blueprint;

/**
 * Blueprint cache for nodes
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Cache
{
	public static array $cache = [];

	public function get(string $cacheId): Node|null
	{
		return static::$cache[$cacheId] ?? null;
	}

	public function set(string $cacheId, Node $node): Node
	{
		return static::$cache[$cacheId] = $node;
	}
}
