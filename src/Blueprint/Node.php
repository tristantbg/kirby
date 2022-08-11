<?php

namespace Kirby\Blueprint;

use Kirby\Architect\Inspector;
use Kirby\Architect\InspectorSection;
use Kirby\Architect\InspectorSections;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Fields;
use Kirby\Field\TextField;

/**
 * A node of the blueprint
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Node
{
	public function __construct(
		public string $id,
		public Extension|null $extends = null,
	) {
	}

	/**
	 * Dynamic getter for properties
	 */
	public function __call(string $name, array $args)
	{
		return $this->$name;
	}

	/**
	 * Apply default values
	 */
	public function defaults(): void
	{
	}

	/**
	 * Creates an instance by a set of array properties.
	 */
	public static function factory(array $props): static
	{
		$props = Extension::apply($props);
		$props = static::polyfill($props);
		return Factory::make(static::class, $props);
	}

	public static function inspector(): Inspector
	{
		return new Inspector(
			id: 'section',
			sections: new InspectorSections([
				new InspectorSection(
					id: 'settings',
					fields: new Fields([
						new TextField(id: 'id'),
						new TextField(id: 'extends'),
					])
				)
			])
		);
	}

	public static function load(string|array $props): static
	{
		// load by path
		if (is_string($props) === true) {
			$props = static::loadProps($props);
		}

		return static::factory($props);
	}

	public static function loadProps(string $path): array
	{
		$config = new Config($path);
		$props  = $config->read();

		// add the id if it's not set yet
		$props['id'] ??= basename($path);

		return $props;
	}

	/**
	 * Optional method that runs before static::factory sends
	 * its properties to the instance. This is perfect to clean
	 * up props or keep deprecated props compatible.
	 */
	public static function polyfill(array $props): array
	{
		return $props;
	}

	public function render(ModelWithContent $model): mixed
	{
		// apply default values
		$this->defaults();

		$array = [];

		// go through all public properties
		foreach (get_object_vars($this) as $key => $value) {
			if (is_object($value) === false && is_resource($value) === false) {
				$array[$key] = $value;
				continue;
			}

			if (method_exists($value, 'render') === true) {
				$array[$key] = $value->render($model);
			}
		}

		// sort keys alphabetically
		ksort($array);
		return $array;
	}

	/**
	 * Universal setter for properties
	 */
	public function set(string $property, mixed $value): static
	{
		$this->$property = Factory::forProperty(static::class, $property, $value);
		return $this;
	}
}
