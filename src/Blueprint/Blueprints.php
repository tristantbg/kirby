<?php

namespace Kirby\Blueprint;

use Kirby\Cms\App;
use Kirby\Exception\LogicException;
use Kirby\Filesystem\Dir;
use Kirby\Filesystem\F;
use Kirby\Toolkit\Str;
use Throwable;

/**
 * Blueprints
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Blueprints extends Nodes
{
	public const FOLDER = null;
	public const TYPE = Blueprint::class;

	public static function load(): static
	{
		$items      = static::preloadExtensions();
		$items      = static::preloadFiles();
		$class      = static::TYPE;
		$collection = new static;

		foreach ($items as $path => $file) {
			try {
				$blueprint = $class::load($path);
			} catch (Throwable $e) {
				throw new LogicException($e->getMessage() . ' (Blueprint: ' . $path . ')');
			}

			$collection->__set($blueprint->id, $blueprint);
		}

		return $collection;
	}

	public static function preloadExtensions(): array
	{
		$items = [];

		// collect all extensions
		foreach (App::instance()->extensions('blueprints') as $path => $file) {

			// without a folder, the path needs to match exactly
			if (empty(static::FOLDER) === true && $path !== static::FOLDER) {
				continue;

			// with a path, the first folder needs to match
			} else if (Str::startsWith($path, static::FOLDER . '/') === false) {
				continue;
			}

			$items[$path] = $file;
		}

		return $items;
	}

	public static function preloadFiles(): array
	{
		$kirby = App::instance();
		$root  = rtrim($kirby->root('blueprints') . '/' . static::FOLDER, '/');
		$items = [];

		foreach (glob($root . '/*.yml') as $file) {
			$path = ltrim(static::FOLDER . '/' . F::name($file), '/');
			$items[$path] = $file;
		}

		return $items;
	}

}
