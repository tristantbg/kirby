<?php

namespace Kirby\Blueprint;

/**
 * File Blueprint options
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FileBlueprintOptions extends BlueprintOptions
{
	public function __construct(
		public BlueprintOption|null $changeName = null,
		public BlueprintOption|null $create = null,
		public BlueprintOption|null $delete = null,
		public BlueprintOption|null $read = null,
		public BlueprintOption|null $replace = null,
		public BlueprintOption|null $update = null,
	) {
	}
}
