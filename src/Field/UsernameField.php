<?php

namespace Kirby\Field;

use Kirby\Attribute\IconAttribute;
use Kirby\Attribute\LabelAttribute;

/**
 * Username field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class UsernameField extends TextField
{
	public const TYPE = 'text';

	public function defaults(): void
	{
		$this->icon  ??= new IconAttribute('user');
		$this->label ??= new LabelAttribute(['*' => 'name']);
	}
}
