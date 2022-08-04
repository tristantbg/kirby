<?php

namespace Kirby\Drawer;

use Kirby\Attribute\IconAttribute;
use Kirby\Field\Fields;
use Kirby\Node\LabelledNode;

/**
 * Drawer
 *
 * @package   Kirby Drawer
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Drawer extends LabelledNode
{
	public function __construct(
		public string $id,
		public IconAttribute|null $icon = null,
		public DrawerTabs|null $tabs = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function fields(): ?Fields
	{
		return $this->tabs?->fields();
	}

	public static function polyfill(array $props): array
	{
		$props = static::polyfillFields($props);
		$props = static::polyfillTitle($props);

		return $props;
	}

	public static function polyfillFields(array $props): array
	{
		if (isset($props['fields']) === true) {
			$props['tabs'] = new DrawerTabs([
				new DrawerTab(
					id: 'content',
					fields: Fields::factory($props['fields'])
				)
			]);
			unset($props['fields']);
		}

		return $props;
	}

}
