<?php

namespace Kirby\Field;

use Kirby\Attribute\IconAttribute;
use Kirby\Attribute\LabelAttribute;
use Kirby\Attribute\PlaceholderAttribute;
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

	public function __construct(
		public string $id,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new EmailValue(
			maxlength: $this->maxlength,
			minlength: $this->minlength,
			pattern:   $this->pattern,
			required:  $this->required,
		);
	}

	public function defaults(): void
	{
		$this->autocomplete ??= 'email';
		$this->counter      ??= false;
		$this->icon         ??= new IconAttribute('email');
		$this->label        ??= new LabelAttribute(['*' => 'email']);
		$this->placeholder  ??= new PlaceholderAttribute(['*' => 'email.placeholder']);

		parent::defaults();
	}
}
