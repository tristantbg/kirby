<?php

namespace Kirby\Blueprint;

use Kirby\Architect\Inspector;
use Kirby\Architect\InspectorSection;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\FieldLabel;
use Kirby\Field\Fields;
use Kirby\Field\ToggleField;

/**
 * Bools
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Bools
{
	public static function factory(bool|array $props): static
	{
		if (is_bool($props) === true) {
			$instance = new static();

			foreach (get_object_vars($instance) as $key => $value) {
				$instance->$key = $props;
			}

			return $instance;
		}

		return new static(...$props);
	}

	public static function inspectorSection(): InspectorSection
	{
		$section  = new InspectorSection(id: 'options', fields: new Fields);
		$instance = new static;

		foreach (get_object_vars($instance) as $key => $value) {
			$section->fields->add(
				new ToggleField(
					id: $key,
					label: new FieldLabel(['en' => $key])
				)
			);
		}

		return $section;
	}

	public function render(ModelWithContent $model): mixed
	{
		$props = (array)$this;
		$props = array_filter($props, fn ($value) => $value === true);

		return array_keys($props);
	}
}
