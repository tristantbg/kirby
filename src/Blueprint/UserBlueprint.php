<?php

namespace Kirby\Blueprint;

use Kirby\Blueprint\Prop\Image;
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
	public const TYPE = 'user';

	public function __construct(
		public string $id,
		public Image|null $image = null,
		public UserOptions|null $options = null,
		public Permissions|null $permissions = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public static function load(string $id): static
	{
		$config = new Config('users/' . $id);

		return static::factory($config->read() + [
			'id' => $id
		]);
	}
}
