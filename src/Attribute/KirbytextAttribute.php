<?php

namespace Kirby\Attribute;

use Kirby\Cms\ModelWithContent;

/**
 * Kirbytext attribute
 *
 * @package   Kirby Attribute
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class KirbytextAttribute extends TextAttribute
{
	public function render(ModelWithContent $model): ?string
	{
		if ($text = parent::render($model)) {
			return $model->kirby()->kirbytext($text);
		}

		return $text;
	}
}
