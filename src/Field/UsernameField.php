<?php

namespace Kirby\Field;

use Kirby\Blueprint\Prop\Icon;
use Kirby\Blueprint\Prop\Label;

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

	public function __construct(...$args)
	{
		$args['icon']  ??= new Icon('user');
		$args['label'] ??= new Label(['*' => 'name']);

		parent::__construct(...$args);
	}
}
