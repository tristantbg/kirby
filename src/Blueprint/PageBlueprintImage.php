<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Image object for pages
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PageBlueprintImage extends BlueprintImage
{
	public function __construct(
		...$args
	) {
		parent::__construct(...$args);
	}

	public function defaults(ModelWithContent $model): void
	{
		$this->query ??= 'page.image';

		parent::defaults($model);
	}
}
