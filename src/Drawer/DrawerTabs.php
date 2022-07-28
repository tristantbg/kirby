<?php

namespace Kirby\Drawer;

use Kirby\Field\Fields;
use Kirby\Foundation\Nodes;

/**
 * Drawer Tabs
 *
 * @package   Kirby Drawer
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class DrawerTabs extends Nodes
{
	public const TYPE = DrawerTab::class;

	/**
	 * Collect all fields in all sections
	 */
	public function fields(): Fields
	{
		$fields = new Fields;

		foreach ($this->data as $tab) {
			foreach ($tab->fields ?? [] as $field) {
				$fields->__set($field->id, $field);
			}
		}

		return $fields;
	}

}
