<?php

namespace Kirby\Blueprint;

use Kirby\Cms\Users;
use Kirby\Cms\ModelWithContent;

/**
 * Users Picker Dialog
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class UsersPickerDialog extends PickerDialog
{
	public const ITEMS = UsersItems::class;

	public function component(): string
	{
		return 'k-users-picker-dialog';
	}

	public function models(ModelWithContent $model, array $query = []): Users
	{
		$models = match (true) {
			// with query
			$this->query !== null => $model->query($this->query),

			// all users
			default => $model->kirby()->users()
		};

		$models = $this->applySearch($models, $query);
		$models = $this->applyPagination($models, $query);

		return $models;
	}
}
