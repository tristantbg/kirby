<?php

namespace Kirby\Dialog;

use Kirby\Blueprint\Prop\Text;
use Kirby\Dialog\Prop\Button;

/**
 * Remove Dialog
 *
 * @package   Kirby Dialog
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class RemoveDialog extends TextDialog
{
	public function defaults(): void
	{
		$this->cancelButton ??= Button::factory('cancel');
		$this->submitButton ??= Button::factory([
			'text'  => 'remove',
			'theme' => 'negative'
		]);
	}
}
