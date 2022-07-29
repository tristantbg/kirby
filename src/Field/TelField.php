<?php

namespace Kirby\Field;

use Kirby\Blueprint\Prop\Icon;

/**
 * Tel field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TelField extends TextField
{
	public const TYPE = 'tel';

	public function defaults(): void
	{
		$this->autocomplete ??= 'tel';
		$this->icon         ??= new Icon('phone');
	}
}
