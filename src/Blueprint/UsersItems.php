<?php

namespace Kirby\Blueprint;

class UsersItems extends Items
{
	public function defaults(): static
	{
		$this->empty ??= new NodeText(['*' => 'users.empty']);
		$this->image ??= new UserBlueprintImage;
		$this->text  ??= new NodeText(['*' => '{{ user.username }}']);

		return parent::defaults();
	}
}
