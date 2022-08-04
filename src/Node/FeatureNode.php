<?php

namespace Kirby\Node;

use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Extension;
use Kirby\Http\Router;
use TypeError;

/**
 * Feature Node
 *
 * @package   Kirby Node
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FeatureNode extends Node
{
	use NodeApi;

	public const TYPE = 'feature';
	public const GROUP = 'feature';

	public function __construct(
		public string $id,
		public NodeConditions|null $when = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function isActive(array $values = []): bool
	{
		return $this->when?->isTrue($values) ?? true;
	}

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
		// apply default values
		$this->defaults();

		return [
			'id'   => $this->id,
			'type' => static::TYPE,
			'when' => $this->when?->render($model)
		];
	}
}
