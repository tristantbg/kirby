<?php

namespace Kirby\Blueprint;

use Kirby\Field\Fields;

/**
 * Drawer Tabs
 *
 * @package   Kirby Blueprint
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
		$fields = new Fields();

		foreach ($this->data as $tab) {
			foreach ($tab->fields ?? [] as $field) {
				$fields->__set($field->id, $field);
			}
		}

		return $fields;
	}
}
