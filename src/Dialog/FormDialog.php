<?php

namespace Kirby\Dialog;

use Kirby\Dialog\Prop\Button;
use Kirby\Field\Fields;

/**
 * Form Dialog
 *
 * @package   Kirby Dialog
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FormDialog extends Dialog
{
	public function __construct(
		public string $id,
		public Fields|null $fields = null,
		public array $value = [],
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->cancelButton ??= Button::factory('cancel');
		$this->submitButton ??= Button::factory([
			'text'  => 'ok',
			'theme' => 'positive'
		]);
	}
}
