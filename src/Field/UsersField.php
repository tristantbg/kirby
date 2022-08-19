<?php

namespace Kirby\Field;

use Kirby\Blueprint\UsersItems;
use Kirby\Blueprint\UsersPickerDialog;
use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Users;

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

	public function models(ModelWithContent $model): Users
	{
		$ids   = $model->revision()->value($this->id);
		$kirby = $model->kirby();
		$users = new Users;

		foreach ($ids ?? [] as $id) {
			if ($user = $kirby->user($id)) {
				$users->add($user);
			}
		}

		return $users;
	}

}
