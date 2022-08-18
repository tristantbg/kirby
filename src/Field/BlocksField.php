<?php

namespace Kirby\Field;

use Kirby\Architect\InspectorSection;
use Kirby\Block\BlockTypeGroups;
use Kirby\Blueprint\EmptyState;
use Kirby\Blueprint\NodeIcon;
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
		public EmptyState|null $empty = null,
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

	public function defaults(): static
	{
		$this->empty ??= new EmptyState(
			icon: new NodeIcon('box'),
			text: new NodeText(['*' => 'field.blocks.empty'])
		);

		$this->types ??= BlockTypeGroups::default();

		return parent::defaults();
	}

	public function dialogs(ModelWithContent $model): array
	{
		$this->defaults();

		return [
			'selector' => [
				'pattern' => '',
				'load'    => function () use ($model) {
					return [
						'component' => 'k-block-selector',
						'props' => [
							'groups' => $this->types?->render($model)
						]
					];
				}
			]
		];
	}

	public static function inspectorDescriptionSection(): InspectorSection
	{
		$section = parent::inspectorDescriptionSection();
		$section->fields->empty = EmptyState::field();

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
			'min'   => $this->min,
		];
	}

	public function routes(ModelWithContent $model): array
	{
		return [
			[
				'pattern' => 'paste',
				'method'  => 'POST',
				'action'  => function () {

				}
			],
			[
				'pattern' => 'types/(:any)',
				'action'  => function (string $id) {



				}
			]
		];
	}

}
