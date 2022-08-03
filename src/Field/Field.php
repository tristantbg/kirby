<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Field\Prop\Width;
use Kirby\Field\Prop\When;
use Kirby\Foundation\Feature;

/**
 * Base field class
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Field extends Feature
{
	public const GROUP = 'field';
	public const TYPE  = 'field';

	public function __construct(
		public string $id,
		public When|null $when = null,
		public Width|null $width = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function fill(mixed $value = null): static
	{
		return $this;
	}

	public function isInput(): bool
	{
		return false;
	}

	public function isActive(array $values = []): bool
	{
		return $this->when?->isTrue($values) ?? true;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'when'  => $this->when?->render($model),
			'width' => $this->width?->render($model) ?? '1/1'
		];
	}

	public function submit(mixed $value = null): static
	{
		return $this;
	}
}
