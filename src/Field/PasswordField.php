<?php

namespace Kirby\Field;

use Kirby\Attribute\IconAttribute;
use Kirby\Attribute\LabelAttribute;

/**
 * Password field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PasswordField extends TextField
{
	public const TYPE = 'password';

	public function defaults(): void
	{
		$this->autocomplete ??= 'password';
		$this->icon         ??= new IconAttribute('key');
		$this->label        ??= new LabelAttribute(['*' => 'password']);
		$this->minlength    ??= 8;

		parent::defaults();
	}
}
