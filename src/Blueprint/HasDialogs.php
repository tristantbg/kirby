<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Http\Router;
use Kirby\Panel\Panel;

/**
 * Blueprint nodes that have dedicated dialogs
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
trait HasDialogs
{
	public function dialogApi(
		ModelWithContent $model,
		string|null $path = null,
		string $method = 'GET',
		array $query = []
	): mixed {
		return Router::execute($path, $method, $this->dialogRoutes($model), function ($route) use ($query) {
			$args   = $route->arguments();
			$args[] = $query;
			$args[] = $route;

			return $route->action()(...$args);
		});
	}

	public function dialogRoutes(ModelWithContent $model): array
	{
		$areaId = 'site';
		$routes = [];

		foreach ($this->dialogs($model) as $id => $dialog) {
			$pattern = trim($dialog['pattern'] ?? $id, '/');

			// load event
			$routes[] = [
				'pattern' => $pattern,
				'type'    => 'dialog',
				'area'    => $areaId,
				'action'  => $dialog['load'] ?? fn () => 'The load handler for your dialog is missing'
			];

			// submit event
			$routes[] = [
				'pattern' => $pattern,
				'type'    => 'dialog',
				'area'    => $areaId,
				'method'  => 'POST',
				'action'  => $dialog['submit'] ?? fn () => 'Your dialog does not define a submit handler'
			];
		}

		return $routes;
	}

	public function dialogs(ModelWithContent $model): array
	{
		return [];
	}
}
