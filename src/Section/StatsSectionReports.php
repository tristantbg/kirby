<?php

namespace Kirby\Section;

use Kirby\Blueprint\Nodes;
use Kirby\Blueprint\Promising;

/**
 * Reports
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class StatsSectionReports extends Nodes
{
	use Promising;

	public const TYPE = Report::class;
}
