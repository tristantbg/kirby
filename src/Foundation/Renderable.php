<?php

namespace Kirby\Foundation;

use Kirby\Cms\ModelWithContent;

/**
 * Renderable
 *
 * @package   Kirby Foundation
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
interface Renderable
{
	public function render(ModelWithContent $model): mixed;
}
