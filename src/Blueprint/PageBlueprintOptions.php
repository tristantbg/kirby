<?php

namespace Kirby\Blueprint;

/**
 * Page Blueprint options
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PageBlueprintOptions extends BlueprintOptions
{
	public const ALIASES = [
		'status'   => 'changeStatus',
		'template' => 'changeTemplate',
		'title'    => 'changeTitle',
		'url'      => 'changeSlug',
	];

	public function __construct(
		public BlueprintOption|null $changeSlug = null,
		public BlueprintOption|null $changeStatus = null,
		public BlueprintOption|null $changeTemplate = null,
		public BlueprintOption|null $changeTitle = null,
		public BlueprintOption|null $create = null,
		public BlueprintOption|null $delete = null,
		public BlueprintOption|null $duplicate = null,
		public BlueprintOption|null $preview = null,
		public BlueprintOption|null $read = null,
		public BlueprintOption|null $update = null,
	) {
	}
}
