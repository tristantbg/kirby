<?php

namespace Kirby\Field;

use Kirby\Blueprint\Prop\Icon;
use Kirby\Field\Prop\Placeholder;
use Kirby\Value\EmailValue;

/**
 * Email field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class EmailField extends TextField
{
	public const TYPE = 'email';

	public function __construct(...$args)
	{
		parent::__construct(...$args);

		$this->autocomplete ??= 'email';
		$this->icon         ??= new Icon('email');
		$this->placeholder  ??= new Placeholder(['*' => 'email.placeholder']);

		$this->value = new EmailValue(
			maxlength: $this->maxlength,
			minlength: $this->minlength,
			pattern:   $this->pattern,
			required:  $this->required,
		);
	}
}
