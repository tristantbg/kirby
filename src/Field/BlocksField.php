<?php

namespace Kirby\Field;

use Kirby\Blueprint\Prop\Text;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Prop\Fieldsets;
use Kirby\Value\JsonValue;

/**
 * Blocks field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlocksField extends InputField
{
	public const TYPE = 'blocks';
	public JsonValue $value;

	public function __construct(
		public string $id,
		public Text|null $empty = null,
		public Fieldsets|null $fieldsets = null,
		public string $group = 'blocks',
		public int|null $max = null,
		public int|null $min = null,
		public bool $pretty = false,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->fieldsets ??= new Fieldsets;

		$this->value = new JsonValue(
			max: $this->max,
			min: $this->min,
			pretty: $this->pretty,
			required: $this->required
		);
	}

}
