<?php

namespace Kirby\Field;

use Kirby\Field\Prop\Marks;
use Kirby\Value\HtmlValue;

/**
 * List field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ListField extends InputField
{
	public const TYPE = 'list';
	public HtmlValue $value;

	public function __construct(
		public string $id,
		public Marks|null $marks = null,
		...$args
	) {
		parent::__construct($id, ...$args);
		$this->value = new HtmlValue;
	}
}
