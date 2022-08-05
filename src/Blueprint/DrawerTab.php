<?php

namespace Kirby\Blueprint;

use Kirby\Field\Fields;

/**
 * Drawer Tab
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class DrawerTab extends NodeLabelled
{
	public function __construct(
		public string $id,
		public Fields|null $fields = null,
		public NodeIcon|null $icon = null,
	) {
		parent::__construct($id);
	}
}
