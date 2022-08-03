<?php

namespace Kirby\Foundation;

/**
 * Collection of nodes
 *
 * @package   Kirby Foundation
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
		$collection = new static;

		foreach ($nodes as $id => $props) {
			if ($props === false) {
				continue;
			}

			$node = match (true) {
				$props === true
					=> static::nodeFactoryById($id),

				is_string($props)
					=> static::nodeFactoryByString($id, $props),

				default
					=> static::nodeFactory($id, $props)
			};

			$collection->__set($node->id, $node);
		}

		return $collection;
	}

	public static function nodeFactory(string|int $id, array $props): Node
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
