<?php

namespace Kirby\Blueprint;

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
		public NodeUrl|null $home = null,
		public UserBlueprintImage|null $image = null,
		public UserBlueprintOptions|null $options = null,
		public Permissions|null $permissions = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function image(): UserBlueprintImage
	{
		return $this->image ?? new UserBlueprintImage;
	}

	public function options(): UserBlueprintOptions
	{
		return $this->options ?? new UserBlueprintOptions;
	}
}
