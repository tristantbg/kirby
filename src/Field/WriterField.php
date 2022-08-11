<?php

namespace Kirby\Field;

use Kirby\Architect\Inspector;
use Kirby\Architect\InspectorSection;
use Kirby\Cms\ModelWithContent;
use Kirby\Value\HtmlValue;

/**
 * Writer field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class WriterField extends InputField
{
	public const TYPE = 'writer';
	public HtmlValue $value;

	public function __construct(
		public string $id,
		public string|null $default = null,
		public bool $inline = false,
		public FieldIcon|null $icon = null,
		public WriterFieldMarks|null $marks = null,
		public WriterFieldNodes|null $nodes = null,
		public FieldPlaceholder|null $placeholder = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new HtmlValue(
			required: $this->required
		);
	}

	public function defaults(): void
	{
		$this->marks ??= new WriterFieldMarks();
		$this->nodes ??= new WriterFieldNodes();

		parent::defaults();
	}

	public static function inspector(): Inspector
	{
		$inspector = parent::inspector();

		$inspector->sections->add(WriterFieldNodes::inspectorSection());
		$inspector->sections->add(WriterFieldMarks::inspectorSection());

		return $inspector;
	}

	public static function inspectorDescriptionSection(): InspectorSection
	{
		$section = parent::inspectorDescriptionSection();

		$section->fields->placeholder = FieldPlaceholder::field();
		$section->fields->icon        = FieldIcon::field();

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
			'icon'        => $this->icon?->render($model),
			'inline'      => $this->inline,
			'marks'       => $this->marks?->render($model),
			'nodes'       => $this->nodes?->render($model),
			'placeholder' => $this->placeholder?->render($model),
		];
	}
}
