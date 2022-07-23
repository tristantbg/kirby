<?php

namespace Kirby\Section\Prop;

use Kirby\Foundation\Collection;
use Kirby\Foundation\Promising;

/**
 * Reports
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Reports extends Collection
{
	use Promising;

	public const TYPE = Report::class;
}
