<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * User blueprint options
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class UserBlueprintOptions extends BlueprintOptions
{
	public function __construct(
		public BlueprintOption|null $changeEmail = null,
		public BlueprintOption|null $changeLanguage = null,
		public BlueprintOption|null $changeName = null,
		public BlueprintOption|null $changePassword = null,
		public BlueprintOption|null $changeRole = null,
		public BlueprintOption|null $create = null,
		public BlueprintOption|null $delete = null,
		public BlueprintOption|null $update = null,
	) {
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'changeEmail'    => $this->changeEmail?->render($model),
			'changeLanguage' => $this->changeLanguage?->render($model),
			'changeName'     => $this->changeName?->render($model),
			'changePassword' => $this->changePassword?->render($model),
			'changeRole'     => $this->changeRole?->render($model),
			'create'         => $this->create?->render($model),
			'delete'         => $this->delete?->render($model),
			'update'         => $this->update?->render($model),
		];
	}
}
