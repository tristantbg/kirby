<?php

namespace Kirby\Blueprint;

/**
 * Collection of nblueprint odes
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Nodes extends Collection
{
	/**
	 * The expected object type
	 */
	public const TYPE = Node::class;

	public static function factory(array $nodes): static
	{
		$collection = new static();

		foreach ($nodes as $id => $props) {
			if ($props === false) {
				continue;
			}

			$node = static::nodeFactory($id, $props);
			$collection->__set($node->id, $node);
		}

		return $collection;
	}

	public static function nodeFactory(string|int $id, array|bool|string|Node $props): Node
	{
		return match (true) {
			$props === true
				=> static::nodeFactoryById($id),

			is_string($props)
				=> static::nodeFactoryByString($id, $props),

			is_array($props)
				=> static::nodeFactoryByArray($id, $props),

			is_object($props)
			    => $props
		};
	}

	public static function nodeFactoryByArray(string|int $id, array $props): Node
	{
		$props['id'] ??= $id;
		return (static::TYPE)::load($props);
	}

	public static function nodeFactoryById(string|int $id): Node
	{
		return static::nodeFactory($id, ['id' => $id]);
	}

	public static function nodeFactoryByString(string|int $id, string $path): Node
	{
		if (is_int($id) === true) {
			$id = basename($path);
		}

		return static::nodeFactory($id, [
			'id'      => $id,
			'extends' => $path
		]);
	}
}
