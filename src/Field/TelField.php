<?php

namespace Kirby\Field;

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
		$this->autocomplete ??= new FieldAutocomplete('tel');
		$this->icon         ??= new FieldIcon('phone');
	}
}
