<?php

namespace Kirby\Blueprint;

use Kirby\Cms\App;
use Kirby\Filesystem\F;
use Throwable;

/**
 * Cache
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

	public function get(string $path): ?Blueprint
	{
		return static::$cache[$path] ?? null;
	}

	public function set(string $path, Blueprint $blueprint): Blueprint
	{
		return static::$cache[$path] = $blueprint;
	}

}
