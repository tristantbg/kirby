<?php

namespace Kirby\Layout;

use Kirby\Node\Nodes;
use Kirby\Toolkit\A;

/**
 * Layout Types
 *
 * @package   Kirby Layout
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class LayoutTypes extends Nodes
{
	public const TYPE = LayoutType::class;

	public static function default(): static
	{
		return static::factory([
			['1/1']
		]);
	}

	public static function nodeFactoryByArray(string|int $id, array $props): LayoutType
	{
		// support passing columns directly without additional info
		if (A::isAssociative($props) === false) {
			$props = [
				'id'      => $id,
				'columns' => $props
			];
		}

		$props['id'] ??= $id;

		return (static::TYPE)::load($props);
	}
}
