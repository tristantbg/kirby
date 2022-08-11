<?php

namespace Kirby\Field;

use Kirby\Architect\Inspector;
use Kirby\Architect\InspectorSection;
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

	public static function inspector(): Inspector
	{
		$inspector = parent::inspector();
		$inspector->sections->add(static::inspectorAppearanceSection());

		return $inspector;
	}

	public static function inspectorDescriptionSection(): InspectorSection
	{
		$section = parent::inspectorDescriptionSection();

		$section->fields->placeholder = FieldPlaceholder::field();
		$section->fields->icon        = FieldIcon::field();

		return $section;
	}

	public static function inspectorAppearanceSection(): InspectorSection
	{
		$section = new InspectorSection(id: 'appearance', fields: new Fields);

		$section->fields->font = TextareaFieldFont::field();
		$section->fields->size = TextareaFieldSize::field();

		return $section;
	}

	public static function inspectorValidationSection(): InspectorSection
	{
		$section = TextField::inspectorValidationSection();
		$section->fields->remove('pattern');

		return $section;
	}

	public static function inspectorValueSection(): InspectorSection
	{
		$section = parent::inspectorValueSection();

		$section->fields->default = new TextField(id: 'default');

		return $section;
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
