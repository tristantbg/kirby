<?php

namespace Kirby\Dialog;

use Kirby\Blueprint\Prop\Text;
use Kirby\Dialog\Prop\Button;

/**
 * Text Dialog
 *
 * @package   Kirby Dialog
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextDialog extends Dialog
{
	public function __construct(
		public string $id,
		public Text|null $text = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->cancelButton ??= Button::factory('cancel');
		$this->submitButton ??= Button::factory('ok');
	}
}
