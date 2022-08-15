<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Blueprint Option
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlueprintOption
{
	public function __construct(
		public array $permissions = ['*' => null]
	) {
	}

	public static function factory(array|bool|null $permissions = null): static
	{
		// sanitize permissions
		$permissions = match (true) {
			// allow for all
			$permissions === true  => ['*' => true],
			// block for all
			$permissions === false => ['*' => false],
			// use global options
			$permissions === null  => ['*' => null],
			// custom array definition per role
			default => $permissions
		};

		return new static($permissions);
	}

	public function for(string $roleId): ?bool
	{
		return $this->permissions[$roleId] ?? $this->permissions['*'] ?? null;
	}

}
