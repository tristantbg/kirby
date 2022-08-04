<?php

namespace Kirby\Report;

use Kirby\Foundation\Promising;
use Kirby\Node\Nodes;

/**
 * Reports
 *
 * @package   Kirby Report
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Reports extends Nodes
{
	use Promising;

	public const TYPE = Report::class;
}
