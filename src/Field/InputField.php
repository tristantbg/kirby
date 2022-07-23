<?php

namespace Kirby\Field;

use Kirby\Blueprint\Prop\Help;
use Kirby\Blueprint\Prop\Label;

/**
 * Base class for all saveable fields
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class InputField extends Field
{
	public const TYPE = 'input';

	public function __construct(
		public string $id,
		public bool $autofocus = false,
		public bool $disabled = false,
		public Help|null $help = null,
		public Label|null $label = null,
		public bool $required = false,
		public bool $translate = true,
		...$args
	) {
		parent::__construct($id, ...$args);
		$this->label ??= Label::fallback($id);
	}
}
