<?php

namespace Kirby\Section;

use Kirby\Cms\ModelWithContent;
use Kirby\Blueprint\Autoload;
use Kirby\Blueprint\Extension;
use Kirby\Foundation\NodeWithType;
use Kirby\Http\Router;

/**
 * Section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Section extends NodeWithType
{
	public const TYPE = 'section';

	public function __construct(
		public string $id,
		public Extension|null $extends = null,
	) {
		$this->defaults();
	}

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
		return Autoload::section($props);
	}

	public static function polyfill(array $props): array
	{
		$props = parent::polyfill($props);

		// convert old headlines to labels
		if (isset($props['headline']) === true) {
			$props['label'] ??= $props['headline'] ?? null;
			unset($props['headline']);
		}

		return $props;
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
