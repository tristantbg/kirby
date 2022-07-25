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

	public static function factory(array $nodes)
	{
		$collection = new static;
		$className  = static::TYPE;

		foreach ($nodes as $id => $props) {
			if ($props === false) {
				continue;
			}

			$props = match (true) {
				// simple instance with just an id
				$props === true => [],

				// extension
				is_string($props) => ['extends' => $props],

				// already defined as array
				is_array($props) => $props
			};

			$props['id'] ??= $id;

			$node = $className::factory($props);
			$collection->__set($node->id, $node);
		}

		return $collection;
	}

}
