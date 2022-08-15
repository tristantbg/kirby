<?php

namespace Kirby\Field;

use Kirby\Architect\InspectorSection;
use Kirby\Cms\ModelWithContent;
use Kirby\Option\Options;
use Kirby\Value\MixedValue;

/**
 * Toggles field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TogglesField extends InputField
{
	public const TYPE = 'toggles';
	public MixedValue $value;

	public function __construct(
		public string $id,
		public mixed $default = null,
		public bool $grow = true,
		public bool $labels = true,
		public Options|null $options = null,
		public bool $reset = true,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new MixedValue(
			required: $this->required
		);
	}

	public static function inspectorAppearanceSection(): InspectorSection
	{
		$section = parent::inspectorAppearanceSection();
		$section->fields->grow   = new ToggleField(id: 'grow');
		$section->fields->labels = new ToggleField(id: 'labels');

		return $section;
	}

	public static function inspectorValueSection(): InspectorSection
	{
		$section = parent::inspectorValueSection();
		$section->fields->default = new TextField(id: 'default');
		$section->fields->reset   = new ToggleField(id: 'reset');

		return $section;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'grow'    => $this->grow,
			'labels'  => $this->labels,
			'options' => $this->options?->render($model),
			'reset'   => $this->reset,
		];
	}
}
