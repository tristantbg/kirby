<?php

namespace Kirby\Blueprint;

use Kirby\Architect\InspectorSection;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Fields;
use Kirby\Field\ToggleField;

/**
 * Blueprint options
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlueprintOptions
{
	public const ALIASES = [];

	public function __call(string $name, array $args): BlueprintOption
	{
		return $this->$name ?? new BlueprintOption;
	}

	public static function factory(array $props): static
	{
		$options = [];

		foreach ($props as $key => $prop) {
			// support for old option names
			$key = static::ALIASES[$key] ?? $key;
			// add the model option to a clean new array
			$options[$key] = BlueprintOption::factory($prop);
		}

		return new static(...$options);
	}

	public static function inspectorSection(): InspectorSection
	{
		$section  = new InspectorSection(id: 'options', fields: new Fields);
		$instance = new static;

		foreach (get_object_vars($instance) as $key => $value) {
			$section->fields->add(
				new ToggleField(id: $key)
			);
		}

		return $section;
	}

	public function render(ModelWithContent $model): array
	{
		return [];
	}
}
