<?php

namespace Kirby\Block;

use Kirby\Blueprint\NodeLabelled;
use Kirby\Blueprint\Polyfill;
use Kirby\Cms\ModelWithContent;

/**
 * Block type group
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlockTypeGroup extends NodeLabelled
{
	public function __construct(
		public string $id,
		public bool $open = true,
		public BlockTypes|null $types = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public static function polyfill(array $props): array
	{
		$props = Polyfill::blockTypes($props);

		// the block type groups had a type attribute
		// in the old implementation. This is no longer
		// necessary.
		unset($props['type']);

		return parent::polyfill($props);
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'types' => $this->types()->render($model),
			'id'    => $this->id,
			'label' => $this->label()->render($model),
			'open'  => $this->open
		];
	}

	public function types(): BlockTypes
	{
		return $this->types ?? new BlockTypes;
	}

}
