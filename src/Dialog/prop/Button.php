<?php

namespace Kirby\Dialog\Prop;

use Kirby\Attribute\TextAttribute;
use Kirby\Enumeration\TextTheme;
use Kirby\Foundation\Component;

/**
 * Button
 *
 * @package   Kirby Button
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Button extends Component
{
	public function __construct(
		public TextAttribute $text,
		public TextTheme|null $theme = null
	) {
	}

	public static function factory(string|array|null $props = null): static
	{
		if (is_string($props) === true) {
			return new static(
				text: new TextAttribute($props)
			);
		}

		return parent::factory($props);
	}
}
