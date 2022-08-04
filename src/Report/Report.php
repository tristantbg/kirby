<?php

namespace Kirby\Report;

use Kirby\Attribute\TextAttribute;
use Kirby\Attribute\UrlAttribute;
use Kirby\Enumeration\TextTheme;
use Kirby\Node\LabelledNode;

/**
 * Report
 *
 * @package   Kirby Report
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Report extends LabelledNode
{
	public function __construct(
		public string $id,
		public TextAttribute|null $info = null,
		public UrlAttribute|null $link = null,
		public TextTheme|null $theme = null,
		public TextAttribute|null $value = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}
}
