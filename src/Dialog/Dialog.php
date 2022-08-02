<?php

namespace Kirby\Dialog;

use Kirby\Dialog\Prop\Button;
use Kirby\Foundation\Node;

/**
 * Dialog
 *
 * @package   Kirby Dialog
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Dialog extends Node
{
	public function __construct(
		public string $id,
		public Button|null $cancelButton = null,
		public Button|null $submitButton = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->cancelButton ??= Button::factory('cancel');
		$this->submitButton ??= Button::factory('ok');
	}
}
