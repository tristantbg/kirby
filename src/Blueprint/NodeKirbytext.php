<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Field\FieldLabel;
use Kirby\Field\TextareaField;

/**
 * Blueprint node with Kirbytext
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeKirbytext extends NodeText
{
	public function render(ModelWithContent $model): ?string
	{
		if ($text = parent::render($model)) {
			return $model->kirby()->kirbytext($text);
		}

		return $text;
	}

	public static function field()
	{
		return new TextareaField(
			id: 'text',
			label: new FieldLabel(['en' => 'Text'])
		);
	}

}
