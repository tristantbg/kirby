<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Component;

/**
 * Image object for pages
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PageImage extends Image
{
	public function __construct(
		...$args
	) {
		parent::__construct(...$args);

		$this->back  ??= 'pattern';
		$this->color ??= 'gray-500';
		$this->icon  ??= 'page';
		$this->query ??= 'page.image';
	}
}
