<?php

namespace Kirby\Field;

use Kirby\Blueprint\Uploads;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Prop\FilesFieldOptions;
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
		public TextareaFieldToolbar|null $buttons = null,
		public bool $counter = true,
		public string|null $default = null,
		public FilesFieldOptions|null $files = null,
		public TextareaFieldFont|null $font = null,
		public FieldIcon|null $icon = null,
		public int|null $maxlength = null,
		public int|null $minlength = null,
		public FieldPlaceholder|null $placeholder = null,
		public TextareaFieldSize|null $size = null,
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
