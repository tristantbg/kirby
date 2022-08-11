<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Field\FieldLabel;
use Kirby\Field\SelectField;
use Kirby\Option\Options;

/**
 * Enumeration
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
abstract class Enumeration
{
	public static array $allowed = [];
	public static mixed $default = null;

	public function __construct(
		public mixed $value = null,
	) {
		$this->set($value);
	}

	/**
	 * Creates an instance for the given value
	 */
	public static function factory(mixed $value): static
	{
		return new static($value);
	}

	public static function field()
	{
		$label = FieldLabel::fallback(static::class);

		return SelectField::factory([
			'id'      => strtolower($label->translations['en']),
			'label'   => $label,
			'options' => static::$allowed
		]);
	}

	public function render(ModelWithContent $model): mixed
	{
		return $this->value;
	}

	public function set(mixed $value): static
	{
		$value ??= static::$default;

		if (in_array($value, static::$allowed, true) === false) {
			throw new InvalidArgumentException('The given value "' . $value . '" is not allowed. Allowed values: ' . implode(', ', static::$allowed));
		}

		$this->value = $value;
		return $this;
	}
}
