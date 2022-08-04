<?php

namespace Kirby\Field\Prop;

use Kirby\Blueprint\Image;
use Kirby\Foundation\Factory;

/**
 * File Picker Options
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Files
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

		Factory::apply($props['image'], Image::class);

		return new static(...$props);
	}
}
