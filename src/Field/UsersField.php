<?php

namespace Kirby\Field;

use Kirby\Blueprint\UsersItems;
use Kirby\Blueprint\UsersPickerDialog;

/**
 * Users field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class UsersField extends PickerField
{
	public const DIALOG = UsersPickerDialog::class;
	public const ITEMS  = UsersItems::class;
	public const TYPE   = 'users';
}
