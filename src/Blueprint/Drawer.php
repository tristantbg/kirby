<?php

namespace Kirby\Blueprint;

use Kirby\Field\Fields;

/**
 * Drawer
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Drawer extends NodeLabelled
{
	public function __construct(
		public string $id,
		public NodeIcon|null $icon = null,
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
		$props = Polyfill::drawer($props);
		$props = Polyfill::title($props);

		return $props;
	}

}
