<?php

namespace Kirby\Field;

use Kirby\Blueprint\NodeFeature;
use Kirby\Cms\ModelWithContent;
use Kirby\Toolkit\Str;
use Throwable;

/**
 * Base field class
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Field extends NodeFeature
{
	public const GROUP = 'field';
	public const TYPE  = 'field';

	public function __construct(
		public string $id,
		public FieldWidth|null $width = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->width ??= new FieldWidth();

		parent::defaults();
	}

	public function fill(mixed $value = null): static
	{
		return $this;
	}

	public function isInput(): bool
	{
		return false;
	}

	public static function load(string|array $props): static
	{
		try {
			return parent::load($props);
		} catch (Throwable $e) {
			return new InfoField(id: 'error-' . Str::random(5));
		}
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'width' => $this->width?->render($model)
		];
	}

	public function submit(mixed $value = null): static
	{
		return $this;
	}
}
