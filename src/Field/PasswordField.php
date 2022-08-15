<?php

namespace Kirby\Field;

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
		$this->autocomplete ??= new FieldAutocomplete('new-password');
		$this->icon         ??= new FieldIcon('key');
		$this->label        ??= new FieldLabel(['*' => 'password']);
		$this->minlength    ??= 8;

		parent::defaults();
	}
}
