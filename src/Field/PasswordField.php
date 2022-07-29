<?php

namespace Kirby\Field;

use Kirby\Blueprint\Prop\Icon;
use Kirby\Blueprint\Prop\Label;
use Kirby\Field\Prop\Placeholder;
use Kirby\Value\EmailValue;

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
		$this->icon         ??= new Icon('key');
		$this->label        ??= new Label(['*' => 'password']);
		$this->minlength    ??= 8;

		parent::defaults();
	}
}
