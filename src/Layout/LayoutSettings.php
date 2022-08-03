<?php

namespace Kirby\Layout;

use Kirby\Blueprint\Prop\Icon;
use Kirby\Drawer\Drawer;

/**
 * Layout Settings
 *
 * @package   Kirby Layout
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

	public function defaults(): void
	{
		$this->icon ??= new Icon('dashboard');
	}
}
