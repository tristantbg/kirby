<?php

namespace Kirby\Blueprint;

use Kirby\Architect\Inspector;
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

	public function defaults(): void
	{
		$this->image   ??= new UserBlueprintImage;
		$this->options ??= new UserBlueprintOptions;
	}

	public static function inspector(): Inspector
	{
		$inspector = parent::inspector();
		$inspector->sections->add(UserBlueprintImage::inspectorSection());
		$inspector->sections->add(UserBlueprintOptions::inspectorSection());

		return $inspector;
	}

	public function path(): string
	{
		return 'users/' . $this->id;
	}
}
