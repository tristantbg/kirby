<?php

namespace Kirby\Blueprint;

/**
 * File Picker Options
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FilePickerOptions extends Component
{
	public function __construct(
		public string|null $query = null,
		public Image|null $image = null
	) {
	}

	public static function factory(string|array $props): static
	{
		if (is_string($props) === true) {
			$props = ['query' => $props];
		}

		return new static(...$props);
	}

}
