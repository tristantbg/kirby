<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Option\Options;
use Kirby\Option\OptionsApi;
use Kirby\Option\OptionsQuery;

/**
 * Foundation for radio and select
 *
 * @package   Kirby Field
 * @author    Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FieldOptions
{

	public function __construct(
		public Options|OptionsApi|OptionsQuery|null $options = null
	) {}

	public static function factory(array $props = []): static
	{
		$props['options'] = match ($props['options'] ?? null) {
			'api'
				=> OptionsApi::factory($props['api']),

			'query'
				=> OptionsQuery::factory($props['query']),

			'children',
			'grandChildren',
			'siblings',
			'index',
			'files',
			'images',
			'documents',
			'videos',
			'audio',
			'code',
			'archives'
				=> OptionsQuery::factory('page.' . $props['options']),

			'pages'
				=> OptionsQuery::factory('site.index'),

			default
				=> Options::factory($props['options'] ?? [])
		};

		return new static($props['options']);
	}

	public function resolve(ModelWithContent|null $model): Options
	{
		if (is_a($this->options, Options::class) === true) {
			return $this->options;
		}

		return $this->options?->resolve($model) ?? new Options();
	}

	public function render(ModelWithContent $model): array
	{
		return $this->options->resolve($model)->render($model);
	}
}
