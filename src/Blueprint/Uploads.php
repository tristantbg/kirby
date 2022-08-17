<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Uploads options
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Uploads
{
	public function __construct(
		public NodeModel|null $parent = null,
		public string|null $template = null
	) {
	}

	public static function factory(string|array $props): static
	{
		if (is_string($props) === true) {
			$props = ['template' => $props];
		}

		return new static(...$props);
	}

	/**
	 * Get the parent model. If a parent query
	 * has been set, the model is queried. Otherwise
	 * the passed model is being used
	 */
	public function parent(ModelWithContent $model): ModelWithContent
	{
		// get the related model
		return $this->parent?->model($model) ?? $model;
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'template' => $this->template
		];
	}
}
