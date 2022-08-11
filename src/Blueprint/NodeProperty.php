<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Field\FieldLabel;
use Kirby\Field\TextField;

/**
 * Represents a property for a node
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
abstract class NodeProperty
{
	abstract public static function factory($value = null): ?static;

	public static function field()
	{
		$label = FieldLabel::fallback(static::class);

		return new TextField(
			id: strtolower($label->translations['en']),
			label: $label,
		);
	}

	public function render(ModelWithContent $model)
	{
		return null;
	}
}
