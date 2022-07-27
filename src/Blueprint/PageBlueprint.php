<?php

namespace Kirby\Blueprint;

use Kirby\Blueprint\Prop\PageImage;
use Kirby\Blueprint\Prop\PageNavigation;
use Kirby\Blueprint\Prop\PageOptions;
use Kirby\Blueprint\Prop\Url;
use Kirby\Blueprint\Prop\PageStatusOptions;

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
	public const TYPE    = 'page';

	public function __construct(
		public string $id,
		public PageImage|null $image = null,
		public PageNavigation|null $navigation = null,
		public string|null $num = null,
		public PageOptions|null $options = null,
		public Url|null $preview = null,
		public PageStatusOptions|null $status = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->image ??= new PageImage;
	}
}
