<?php

namespace Kirby\Foundation;

use Kirby\Cms\ModelWithContent;
use Kirby\Http\Router;

/**
 * Feature
 *
 * @package   Kirby Foundation
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Feature extends NodeWithType
{
	public function api(ModelWithContent $model, string|null $path = null, string $method = 'GET', array $query = []): mixed
	{
		return Router::execute($path, $method, $this->routes($model), function ($route) use ($query) {
			$args   = $route->arguments();
			$args[] = $query;
			$args[] = $route;

			return $route->action()(...$args);
		});
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
