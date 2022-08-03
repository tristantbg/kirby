<?php

namespace Kirby\Drawer;

use Kirby\Attribute\IconAttribute;
use Kirby\Attribute\LabelAttribute;
use Kirby\Field\Fields;
use Kirby\Foundation\Node;

/**
 * Drawer
 *
 * @package   Kirby Drawer
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Drawer extends Node
{
	public function __construct(
		public string $id,
		public IconAttribute|null $icon = null,
		public LabelAttribute|null $label = null,
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
		if (isset($props['title']) === true) {
			$props['label'] ??= $props['title'];
		}

		if (isset($props['fields']) === true) {
			$props['tabs'] = new DrawerTabs([
				new DrawerTab(
					id: 'content',
					fields: Fields::factory($props['fields'])
				)
			]);
		}

		unset($props['fields']);
		unset($props['title']);

		return $props;
	}

}
