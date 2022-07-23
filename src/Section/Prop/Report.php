<?php

namespace Kirby\Section\Prop;

use Kirby\Foundation\Component;
use Kirby\Foundation\Promising;

use Kirby\Blueprint\Prop\Label;
use Kirby\Blueprint\Prop\Text;
use Kirby\Blueprint\Prop\Theme;
use Kirby\Blueprint\Prop\Url;

/**
 * Report
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Report extends Component
{
	use Promising;

	public function __construct(
		public string|null $id = null,
		public Text|null $info = null,
		public Label|null $label = null,
		public Url|null $link = null,
		public Theme|null $theme = null,
		public Text|null $value = null,
	) {
		$this->label ??= Label::fallback($id);
	}
}
