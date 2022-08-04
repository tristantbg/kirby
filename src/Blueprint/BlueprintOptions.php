<?php

namespace Kirby\Blueprint;

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
}
