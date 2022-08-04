<?php

namespace Kirby\Blueprint;

use Kirby\Attribute\UrlAttribute;

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
		public UrlAttribute|null $preview = null,
		public PageBlueprintStatus|null $status = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function image(): PageBlueprintImage
	{
		return $this->image ?? new PageBlueprintImage;
	}

	public function navigation(): PageBlueprintNavigation
	{
		return $this->navigation ?? new PageBlueprintNavigation;
	}

	public function options(): PageBlueprintOptions
	{
		return $this->options ?? new PageBlueprintOptions;
	}

	public function status(): PageBlueprintStatus
	{
		return $this->status ?? new PageBlueprintStatus;
	}
}
