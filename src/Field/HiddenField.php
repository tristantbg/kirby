<?php

namespace Kirby\Field;

use Kirby\Value\MixedValue;

/**
 * Hidden field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class HiddenField extends Field
{
	public const TYPE = 'hidden';
	public MixedValue $value;

	public function __construct(
		public string $id
	) {
		$this->value = new MixedValue;
	}
}
