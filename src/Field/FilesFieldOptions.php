<?php

namespace Kirby\Field\Prop;

use Kirby\Blueprint\BlueprintImage;
use Kirby\Blueprint\Factory;

/**
 * File Picker Options
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FilesFieldOptions
{
	public function __construct(
		public string|null $query = null,
		public BlueprintImage|null $image = null
	) {
	}

	public static function factory(string|array $props): static
	{
		if (is_string($props) === true) {
			$props = ['query' => $props];
		}

		$props = Factory::apply($props, [
			'image' => Image::class
		]);

		return new static(...$props);
	}
}
