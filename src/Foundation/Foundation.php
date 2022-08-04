<?php

namespace Kirby\Foundation;

use Kirby\Cms\ModelWithContent;
use ReflectionNamedType;
use ReflectionProperty;
use ReflectionUnionType;

/**
 * Base object
 *
 * @package   Kirby Foundation
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Foundation
{
	/**
	 * Dynamic getter for properties
	 */
	public function __call(string $name, array $args)
	{
		return $this->$name;
	}

	/**
	 * Creates an instance by a set of array properties.
	 */
	public static function factory(array $props): static
	{
		return Factory::make(static::class, static::polyfill($props));
	}

	/**
	 * Universal setter for properties
	 */
	public function set(string $property, mixed $value): static
	{
		$this->$property = Factory::forProperty(static::class, $property, $value);
		return $this;
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
}
