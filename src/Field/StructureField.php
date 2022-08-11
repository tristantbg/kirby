<?php

namespace Kirby\Field;

use Kirby\Architect\InspectorSection;
use Kirby\Blueprint\NodeText;
use Kirby\Blueprint\Polyfill;
use Kirby\Cms\ModelWithContent;
use Kirby\Table\TableColumns;
use Kirby\Value\YamlValue;

/**
 * Structure field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class StructureField extends InputField
{
	public const TYPE = 'structure';
	public YamlValue $value;

	public function __construct(
		public string $id,
		public TableColumns|null $columns = null,
		public array|null $default = null,
		public bool $duplicate = true,
		public NodeText|null $empty = null,
		public Fields|null $fields = null,
		public int|null $limit = null,
		public int|null $max = null,
		public int|null $min = null,
		public bool $prepend = false,
		public string|null $sortBy = null,
		public bool $sortable = true,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new YamlValue(
			max: $this->max,
			min: $this->min,
			required: $this->required,
		);
	}

	public static function inspectorDescriptionSection(): InspectorSection
	{
		$section = parent::inspectorDescriptionSection();
		$section->fields->empty = NodeText::field()->set('id', 'empty')->set('label', 'Empty');

		return $section;
	}

	public static function inspectorValidationSection(): InspectorSection
	{
		$section = parent::inspectorValidationSection();

		$section->fields->min = new NumberField(id: 'min');
		$section->fields->max = new NumberField(id: 'max');

		return $section;
	}

	public static function inspectorValueSection(): InspectorSection
	{
		$section = parent::inspectorValueSection();
		$section->fields->prepend   = new ToggleField(id: 'prepend');
		$section->fields->duplicate = new ToggleField(id: 'duplicate');

		return $section;
	}

	public static function polyfill(array $props): array
	{
		return Polyfill::tableColumns($props);
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'columns'   => $this->columns?->render($model),
			'duplicate' => $this->duplicate,
			'empty'     => $this->empty?->render($model),
			'prepend'   => $this->prepend,
			'sortable'  => $this->sortable
		];
	}
}
