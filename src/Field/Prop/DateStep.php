<?php

namespace Kirby\Field\Prop;

use Kirby\Foundation\Component;

/**
 * Date step
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class DateStep extends Component
{
	public function __construct(
		public int $size = 1,
		public string $unit = 'day',
	) {

	}
}
