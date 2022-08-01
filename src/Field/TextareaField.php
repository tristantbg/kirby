<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Blueprint\Prop\Icon;
use Kirby\Field\Prop\Files;
use Kirby\Field\Prop\Font;
use Kirby\Field\Prop\FontSize;
use Kirby\Field\Prop\Placeholder;
use Kirby\Field\Prop\Toolbar;
use Kirby\Field\Prop\Uploads;
use Kirby\Value\StringValue;

/**
 * Textarea field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextareaField extends InputField
{
	public const TYPE = 'textarea';
	public StringValue $value;

	public function __construct(
		string $id,
		public Toolbar|null $buttons = null,
		public bool $counter = true,
		public string|null $default = null,
		public Files|null $files = null,
		public Font|null $font = null,
		public Icon|null $icon = null,
		public int|null $maxlength = null,
		public int|null $minlength = null,
		public Placeholder|null $placeholder = null,
		public FontSize|null $size = null,
		public bool $spellcheck = true,
		public Uploads|null $uploads = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new StringValue(
			maxlength: $this->maxlength,
			minlength: $this->minlength,
			required:  $this->required,
		);
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'buttons'     => $this->buttons?->render($model),
			'counter'     => $this->counter,
			'files'       => $this->files?->render($model),
			'font'        => $this->font?->value,
			'icon'        => $this->icon?->render($model),
			'maxlength'   => $this->maxlength,
			'minlength'   => $this->minlength,
			'placeholder' => $this->placeholder?->render($model),
			'size'        => $this->size?->value,
			'spellcheck'  => $this->spellcheck,
			'uploads'     => $this->uploads?->render($model)
		];
	}
}
