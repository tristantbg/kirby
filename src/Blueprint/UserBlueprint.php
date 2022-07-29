<?php

namespace Kirby\Blueprint;

use Kirby\Blueprint\Prop\Url;
use Kirby\Blueprint\Prop\UserImage;
use Kirby\Blueprint\Prop\UserOptions;
use Kirby\Permissions\Permissions;

/**
 * User blueprint
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class UserBlueprint extends Blueprint
{
	public const DEFAULT = 'users/default';
	public const TYPE    = 'user';

	public function __construct(
		public string $id,
		public Url|null $home = null,
		public UserImage|null $image = null,
		public UserOptions|null $options = null,
		public Permissions|null $permissions = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->image ??= new UserImage;

		parent::defaults();
	}
}
