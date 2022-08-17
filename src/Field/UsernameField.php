<?php

namespace Kirby\Field;

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

	public function defaults(): static
	{
		$this->icon  ??= new FieldIcon('user');
		$this->label ??= new FieldLabel(['*' => 'name']);

		return parent::defaults();
	}
}
