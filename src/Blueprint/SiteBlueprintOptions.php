<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Site blueprint options
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class SiteBlueprintOptions extends BlueprintOptions
{
	public function __construct(
		public BlueprintOption|null $changeTitle = null,
		public BlueprintOption|null $update = null,
	) {
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'changeTitle'    => $this->changeTitle?->render($model),
			'update'         => $this->update?->render($model),
		];
	}
}
