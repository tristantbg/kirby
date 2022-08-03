<?php

namespace Kirby\Attribute;

use Kirby\Cms\ModelWithContent;

/**
 * The text attribute is translatable
 * and will parse template strings
 *
 * @package   Kirby Attribute
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextAttribute extends I18nAttribute
{
	public function render(ModelWithContent $model): ?string
	{
		if ($text = parent::render($model)) {
			return $model->toSafeString($text);
		}

		return $text;
	}
}
