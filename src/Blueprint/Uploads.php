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
		public string|null $parent = null,
		public string|null $template = null
	) {
	}

	public static function factory(string|array $props): static
	{
		if (is_string($props) === true) {
			$props = ['parent' => $props];
		}

		return new static(...$props);
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'parent'   => $this->parent,
			'template' => $this->template
		];
	}
}
