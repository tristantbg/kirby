<?php

namespace Kirby\Block;

use Kirby\Attribute\LabelAttribute;
use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Node;

/**
 * Block type group
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlockTypeGroup extends Node
{
	public function __construct(
		public string $id,
		public LabelAttribute|null $label = null,
		public bool $open = true,
		public BlockTypes|null $types = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public static function polyfill(array $props): array
	{
		if (isset($props['fieldsets']) === true) {
			$props['types'] ??= $props['fieldsets'];
		}

		unset($props['fieldsets']);
		unset($props['type']);

		return parent::polyfill($props);
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'types' => $this->types?->render($model),
			'id'    => $this->id,
			'label' => $this->label?->render($model),
			'open'  => $this->open
		];
	}

}
