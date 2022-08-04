<?php

namespace Kirby\Drawer;

use Kirby\Attribute\IconAttribute;
use Kirby\Field\Fields;
use Kirby\Node\LabelledNode;

/**
 * Drawer Tab
 *
 * @package   Kirby Drawer
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class DrawerTab extends LabelledNode
{
	public function __construct(
		public string $id,
		public Fields|null $fields = null,
		public IconAttribute|null $icon = null,
	) {
		parent::__construct($id);
	}
}
