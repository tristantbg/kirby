<?php

namespace Kirby\Foundation;

use Kirby\Blueprint\Extension;
use Kirby\Cms\ModelWithContent;
use TypeError;

/**
 * Node with type
 *
 * @package   Kirby Foundation
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeWithType extends Node
{
	public const TYPE = 'node';
	public const GROUP = 'node';

	public static function load(string|array $props): static
	{
		// load by path
		if (is_string($props) === true) {
			$props = static::loadProps($props);
		}

		// already apply the extension to get the correct type
		$props = Extension::apply($props);

		// find the object type
		$type  = $props['type'] ??= $props['id'];
		$group = ucfirst(static::GROUP);
		$class = 'Kirby\\' . $group  . '\\' . ucfirst($type) . $group;

		// check for a valid type
		if (class_exists($class) === false) {
			throw new TypeError('The ' . static::GROUP . ' type "' . $type . '" does not exist');
		}

		// remove the type prop
		// the classes take care of defining
		// their type attribute
		unset($props['type']);

		return $class::factory($props);
	}

	public function render(ModelWithContent $model): array
	{
		$render = parent::render($model);

		// always add id and type to the result
		$render['id']   ??= $this->id;
		$render['type'] ??= static::TYPE;

		ksort($render);

		return $render;
	}
}
