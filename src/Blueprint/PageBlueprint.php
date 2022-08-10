<?php

namespace Kirby\Blueprint;

/**
 * Page blueprint
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PageBlueprint extends Blueprint
{
	public const DEFAULT = 'pages/default';

	public function __construct(
		public string $id,
		public PageBlueprintImage|null $image = null,
		public PageBlueprintNavigation|null $navigation = null,
		public string|null $num = null,
		public PageBlueprintOptions|null $options = null,
		public NodeUrl|null $preview = null,
		public PageBlueprintStatus|null $status = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->image      ??= new PageBlueprintImage;
		$this->navigation ??= new PageBlueprintNavigation;
		$this->options    ??= new PageBlueprintOptions;
		$this->status     ??= new PageBlueprintStatus;
	}

	public function path(): string
	{
		return 'pages/' . $this->id;
	}
}
