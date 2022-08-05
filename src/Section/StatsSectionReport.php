<?php

namespace Kirby\Section;

use Kirby\Blueprint\NodeLabelled;
use Kirby\Blueprint\NodeText;
use Kirby\Blueprint\NodeUrl;

/**
 * Report
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class StatsSectionReport extends NodeLabelled
{
	public function __construct(
		public string $id,
		public NodeText|null $info = null,
		public NodeUrl|null $link = null,
		public SectionTextTheme|null $theme = null,
		public NodeText|null $value = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}
}
