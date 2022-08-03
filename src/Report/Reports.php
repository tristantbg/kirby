<?php

namespace Kirby\Report;

use Kirby\Foundation\Collection;
use Kirby\Foundation\Promising;

/**
 * Reports
 *
 * @package   Kirby Report
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
