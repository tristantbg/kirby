<?php

namespace Kirby\Dialog;

use Kirby\Dialog\Prop\Button;
use Kirby\Foundation\Component;

/**
 * Dialog
 *
 * @package   Kirby Dialog
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Dialog extends Component
{
	public function __construct(
		public string $id,
		public Button|null $cancelButton = null,
		public Button|null $submitButton = null,
	) {
	}
}
