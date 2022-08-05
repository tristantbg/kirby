<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Http\Router;

/**
 * Blueprint nodes that have dedeicated API routes
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
trait HasApi
{
	public function api(ModelWithContent $model, string|null $path = null, string $method = 'GET', array $query = []): mixed
	{
		return Router::execute($path, $method, $this->routes, function ($route) use ($query) {
			$args   = $route->arguments();
			$args[] = $query;
			$args[] = $route;

			return $route->action()(...$args);
		});
	}

	public function routes(ModelWithContent $model): array
	{
		return [];
	}
}
