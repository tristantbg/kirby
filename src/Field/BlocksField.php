<?php

namespace Kirby\Field;

use Kirby\Cms\App;
use Kirby\Cms\ModelWithContent;
use Kirby\Blueprint\Prop\Text;
use Kirby\Block\BlockTypeGroups;
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
		public string $group = 'blocks',
		public int|null $max = null,
		public int|null $min = null,
		public bool $pretty = false,
		public BlockTypeGroups|null $types = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new JsonValue(
			max: $this->max,
			min: $this->min,
			pretty: $this->pretty,
			required: $this->required
		);
	}

	/**
	 * Keep the old fieldsets option compatible
	 */
	public static function polyfill(array $props): array
	{
		if (isset($props['fieldsets']) === true) {
			$props['types'] ??= $props['fieldsets'];
			unset($props['fieldsets']);
		}

		return $props;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'empty' => $this->empty?->render($model),
			'group' => $this->group,
			'max'   => $this->max,
			'min'   => $this->min
		];
	}

	/**
	 * Returns all block type groups and falls back
	 * to the groups defined in the config
	 */
	public function types(): BlockTypeGroups
	{
		return $this->types ??= BlockTypeGroups::default();
	}

}
