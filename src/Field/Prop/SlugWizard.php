<?php

namespace Kirby\Field\Prop;

use Kirby\Blueprint\Prop\Text;
use Kirby\Foundation\Component;

/**
 * Slug wizard
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class SlugWizard extends Component
{
	public function __construct(
		public string $field,
		public Text $text
	) {
	}
}
