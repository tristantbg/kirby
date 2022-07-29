<?php

namespace Kirby\Field;

use Kirby\Field\Prop\Marks;
use Kirby\Field\Prop\Nodes;
use Kirby\Value\HtmlValue;

/**
 * Writer field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class WriterField extends InputField
{
	public const TYPE = 'writer';
	public HtmlValue $value;

	public function __construct(
		public string $id,
		public bool $inline = false,
		public Marks|null $marks = null,
		public Nodes|null $nodes = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new HtmlValue(
			required: $this->required
		);
	}

	public function defaults(): void
	{
		$this->marks ??= new Marks;
		$this->nodes ??= new Nodes;
	}
}
