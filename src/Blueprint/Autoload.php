<?php

namespace Kirby\Blueprint;

use Kirby\Field\Field;
use Kirby\Block\BlockType;
use Kirby\Foundation\Component;
use Kirby\Section\Section;
use Kirby\Toolkit\Str;
use TypeError;

/**
 * Autoloader for blueprint components
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Autoload
{
	public static function blueprint(string|array $props): Blueprint
	{
		return static::type('blueprint', $props);
	}

	public static function field(string|array $props): Field
	{
		return static::type('field', $props);
	}

	public static function section(string|array $props): Section
	{
		return static::type('section', $props);
	}

	public static function type(string $group, array|string $props): Component
	{
		// load by path
		if (is_string($props) === true) {
			$path   = $props;
			$config = new Config($path);
			$props  = $config->read();

			// add the id if it's not set yet
			$props['id'] ??= basename($path);
		}

		// already apply the extension to get the correct type
		$props = Extension::apply($props);

		// find the object type
		$type  = $props['type'] ??= $props['id'];
		$class = 'Kirby\\' . ucfirst($group) . '\\' . ucfirst($type) . ucfirst($group);

		// check for a valid type
		if (class_exists($class) === false) {
			throw new TypeError('The ' . $group . ' type "' . $type . '" does not exist');
		}

		// remove the type prop
		// the classes take care of defining
		// their type attribute
		unset($props['type']);

		return $class::factory($props);
	}
}
