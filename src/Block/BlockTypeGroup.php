<?php

namespace Kirby\Block;

use Kirby\Cms\ModelWithContent;
use Kirby\Blueprint\Extension;
use Kirby\Blueprint\Prop\Label;
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
		public BlockTypes|null $blocks = null,
		public Label|null $label = null,
		public bool $open = true,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->label ??= Label::fallback($this->id);
	}

	public static function polyfill(array $props): array
	{
		if (isset($props['fieldsets']) === true) {
			$props['blocks'] ??= $props['fieldsets'];
		}

		unset($props['fieldsets']);
		unset($props['type']);

		return parent::polyfill($props);
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'blocks' => $this->blocks?->render($model),
			'id'     => $this->id,
			'label'  => $this->label?->render($model),
			'open'   => $this->open
		];
	}

}
