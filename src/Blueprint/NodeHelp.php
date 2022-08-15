<?php

namespace Kirby\Blueprint;

use Kirby\Field\TextareaField;

/**
 * Additional help text below the node
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeHelp extends NodeKirbytext
{
	public static function field()
	{
		return new TextareaField(
			id: 'help'
		);
	}
}
