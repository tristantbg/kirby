<?php

namespace Kirby\Section\Prop;

use Kirby\Blueprint\Prop\Label;
use Kirby\Blueprint\Prop\Text;
use Kirby\Blueprint\Prop\Url;
use Kirby\Enumeration\TextTheme;
use Kirby\Foundation\Node;
use Kirby\Foundation\Promising;

/**
 * Report
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Report extends Node
{
	public function __construct(
		public string $id,
		public Text|null $info = null,
		public Label|null $label = null,
		public Url|null $link = null,
		public TextTheme|null $theme = null,
		public Text|null $value = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}
}
