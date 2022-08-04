<?php

namespace Kirby\Blueprint;

/**
 * Site blueprint options
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class SiteBlueprintOptions extends BlueprintOptions
{
	public function __construct(
		public BlueprintOption|null $changeTitle = null,
		public BlueprintOption|null $update = null,
	) {
	}
}
