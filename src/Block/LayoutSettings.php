<?php

namespace Kirby\Block;

use Kirby\Blueprint\Drawer;
use Kirby\Blueprint\NodeIcon;

/**
 * Layout Settings
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class LayoutSettings extends Drawer
{
	public function __construct(
		...$args
	) {
		parent::__construct('settings', ...$args);
	}

	public function defaults(): static
	{
		$this->icon ??= new NodeIcon('dashboard');

		return parent::defaults();
	}
}
