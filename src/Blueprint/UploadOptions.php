<?php

namespace Kirby\Blueprint;

use Kirby\Foundation\Component;

/**
 * Uploads options
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class UploadOptions extends Component
{
	public function __construct(
		public string|null $parent = null,
		public string|null $template = null
	) {
	}

	public static function factory(string|array $props): static
	{
		if (is_string($props) === true) {
			$props = ['parent' => $props];
		}

		return new static(...$props);
	}
}
