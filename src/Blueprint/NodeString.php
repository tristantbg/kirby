<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Enumeration\TextSize;
use Kirby\Field\FieldLabel;
use Kirby\Field\TextField;

/**
 * Simple string blueprint node
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeString extends NodeOfKind
{
	public function __construct(
		public string $value,
	) {
	}

	public static function factory($value = null): ?static
	{
		if ($value === null) {
			return $value;
		}

		return new static($value);
	}

	public static function field()
	{
		$label = FieldLabel::fallback(static::class);

		return new TextField(
			id: strtolower($label->translations['en']),
			label: $label,
		);
	}

	public function render(ModelWithContent $model): ?string
	{
		return $this->value;
	}
}
