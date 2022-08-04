<?php

namespace Kirby\Foundation;

use ReflectionNamedType;
use ReflectionProperty;
use ReflectionUnionType;

/**
 * Factory
 *
 * @package   Kirby Foundation
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Factory
{
	public static function apply(&$value, string $class): void
	{
		if ($value === null || is_a($value, $class) === true) {
			return;
		}

		$value = $class::factory($value);
	}

	public static function forNamedType(ReflectionNamedType|null $type, mixed $value): mixed
	{
		// get the class name for the single type
		$className = $type->getName();

		// check if there's a factory for the value
		if (method_exists($className, 'factory') === true) {
			return $className::factory($value);
		}

		// try to assign the value directly and trust
		// in PHP's type system.
		return $value;
	}

	public static function forProperties(string $class, array $properties): array
	{
		foreach ($properties as $property => $value) {
			$properties[$property] = static::forProperty($class, $property, $value);
		}

		return $properties;
	}

	public static function forProperty(string $class, string $property, mixed $value): mixed
	{
		if (is_null($value) === true) {
			return $value;
		}

		// instantly assign objects
		// PHP's type system will find issues automatically
		if (is_object($value) === true) {
			return $value;
		}

		// get the type for the property
		$reflection = new ReflectionProperty($class, $property);
		$propType   = $reflection->getType();

		// no type given
		if ($propType === null) {
			return $value;
		}

		// union types
		if (is_a($propType, ReflectionUnionType::class) === true) {
			return static::forUnionType($propType, $value);
		}

		return static::forNamedType($propType, $value);
	}

	/**
	 * For properties with union types,
	 * the first named type is used to create
	 * the factory or pass a built-in value
	 */
	public static function forUnionType(ReflectionUnionType $type, mixed $value): mixed
	{
		return static::forNamedType($type->getTypes()[0], $value);
	}

	public static function make(string $class, array $properties): object
	{
		foreach ($properties as $property => $value) {
			$properties[$property] = static::forProperty($class, $property, $value);
		}

		return new $class(...$properties);
	}

}
