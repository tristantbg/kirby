<?php

namespace Kirby\Node;

use Kirby\Cms\ModelWithContent;
use Kirby\Http\Router;

/**
 * Node Api
 *
 * @package   Kirby Node
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
trait NodeApi
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
