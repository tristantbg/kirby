<?php

namespace Kirby\Blueprint;

use Kirby\Table\TableColumns;
use Kirby\Value\YamlValue;

/**
 * Structure field
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class StructureField extends InputField
{
	public const TYPE = 'structure';
	public YamlValue $value;

	public function __construct(
		public string $id,
		public TableColumns|null $columns = null,
		public array|null $default = null,
		public bool $duplicate = true,
		public Text|null $empty = null,
		public Fields|null $fields = null,
		public int|null $limit = null,
		public int|null $max = null,
		public int|null $min = null,
		public bool $prepend = false,
		public string|null $sortBy = null,
		public bool $sortable = true,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new YamlValue(
			max: $this->max,
			min: $this->min,
			required: $this->required,
		);
	}

}
