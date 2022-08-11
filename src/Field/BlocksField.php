<?php

namespace Kirby\Field;

use Kirby\Architect\InspectorSection;
use Kirby\Block\BlockTypeGroups;
use Kirby\Blueprint\NodeText;
use Kirby\Blueprint\Polyfill;
use Kirby\Cms\ModelWithContent;
use Kirby\Value\JsonValue;

/**
 * Blocks field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlocksField extends InputField
{
	public const TYPE = 'blocks';
	public JsonValue $value;

	public function __construct(
		public string $id,
		public NodeText|null $empty = null,
		public string $group = 'blocks',
		public int|null $max = null,
		public int|null $min = null,
		public bool $pretty = false,
		public BlockTypeGroups|null $types = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new JsonValue(
			max: $this->max,
			min: $this->min,
			pretty: $this->pretty,
			required: $this->required
		);
	}

	public static function inspectorDescriptionSection(): InspectorSection
	{
		$section = parent::inspectorDescriptionSection();
		$section->fields->empty = NodeText::field()->set('id', 'empty')->set('label', 'Empty');

		return $section;
	}

	public static function inspectorSettingsSection(): InspectorSection
	{
		$section = parent::inspectorSettingsSection();
		$section->fields->group = new TextField(id: 'group');

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
		$section->fields->pretty = new ToggleField(id: 'pretty');

		return $section;
	}

	/**
	 * Keep the old fieldsets option compatible
	 */
	public static function polyfill(array $props): array
	{
		return Polyfill::blockTypes($props);
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'empty' => $this->empty?->render($model),
			'group' => $this->group,
			'max'   => $this->max,
			'min'   => $this->min
		];
	}

	/**
	 * Returns all block type groups and falls back
	 * to the groups defined in the config
	 */
	public function types(): BlockTypeGroups
	{
		return $this->types ??= BlockTypeGroups::default();
	}
}
