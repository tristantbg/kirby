<?php

namespace Kirby\Foundation;

use Kirby\Cms\ModelWithContent;
use Kirby\Http\Router;
use TypeError;

/**
 * Feature
 *
 * @package   Kirby Foundation
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Feature extends Node
{
	public const TYPE = 'feature';
	public const GROUP = 'feature';

	public function api(ModelWithContent $model, string|null $path = null, string $method = 'GET', array $query = []): mixed
	{
		return Router::execute($path, $method, $this->routes($model), function ($route) use ($query) {
			$args   = $route->arguments();
			$args[] = $query;
			$args[] = $route;

			return $route->action()(...$args);
		});
	}

	public static function load(string|array $props): static
	{
		// load by path
		if (is_string($props) === true) {
			$props = static::loadProps($props);
		}

		// already apply the extension to get the correct type
		$props = Extension::apply($props);

		// find the object type
		$type  = $props['type'] ??= $props['id'];
		$group = ucfirst(static::GROUP);
		$class = 'Kirby\\' . $group  . '\\' . ucfirst($type) . $group;

		// check for a valid type
		if (class_exists($class) === false) {
			throw new TypeError('The ' . static::GROUP . ' type "' . $type . '" does not exist');
		}

		// remove the type prop
		// the classes take care of defining
		// their type attribute
		unset($props['type']);

		return $class::factory($props);
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'id'   => $this->id,
			'type' => static::TYPE,
		];
	}

	public function routes(ModelWithContent $model): array
	{
		return [];
	}
}
