<?php

namespace Kirby\Field;

use Kirby\Architect\InspectorSection;
use Kirby\Cms\ModelWithContent;
use Kirby\Value\OptionValue;

/**
 * Foundation for radio and select
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class OptionField extends InputField
{
	public const TYPE = 'option';
	public OptionValue $value;

	public function __construct(
		public string $id,
		public string|int|float|null $default = null,
		public FieldOptions|null $options = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new OptionValue(
			// resolve options lazily to avoid processing
			// them on construction
			allowed: fn ($model) => $this->options()->resolve($model)->keys(),
			required: $this->required,
		);
	}

	public function options(): FieldOptions
	{
		return $this->options ?? new FieldOptions();
	}

	public static function polyfill(array $props): array
	{
		return parent::polyfill(FieldOptions::polyfill($props));
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
			'options' => $this->options?->render($model)
		];
	}
}
