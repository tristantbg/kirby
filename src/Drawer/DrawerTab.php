<?php

namespace Kirby\Drawer;

use Kirby\Blueprint\Prop\Icon;
use Kirby\Blueprint\Prop\Label;
use Kirby\Field\Fields;
use Kirby\Foundation\Node;

/**
 * Drawer Tab
 *
 * @package   Kirby Drawer
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class DrawerTab extends Node
{
	public function __construct(
		public string $id,
		public Fields|null $fields = null,
		public Icon|null $icon = null,
		public Label|null $label = null,
	) {
		parent::__construct($id);
	}

	public function defaults(): void
	{
		$this->label ??= Label::fallback($this->id);
	}
}
