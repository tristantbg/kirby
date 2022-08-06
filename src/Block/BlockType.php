<?php

namespace Kirby\Block;

use Kirby\Blueprint\Drawer;
use Kirby\Blueprint\DrawerTabs;
use Kirby\Blueprint\NodeIcon;
use Kirby\Blueprint\NodeLabel;
use Kirby\Blueprint\NodeLabelled;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Fields;

/**
 * Block type
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlockType extends NodeLabelled
{
	public function __construct(
		public string $id,
		public bool $disabled = false,
		public bool $editable = true,
		public NodeIcon|null $icon = null,
		public NodeLabel|null $name = null,
		public string|null $preview = null,
		public DrawerTabs|null $tabs = null,
		public bool $translate = true,
		public bool $unset = false,
		public bool $wysiwyg = false,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function drawer(): Drawer
	{
		return new Drawer(
			id: $this->id,
			icon: $this->icon,
			label: $this->label,
			tabs: $this->tabs
		);
	}

	public function fields(): ?Fields
	{
		return $this->tabs->fields();
	}

	public function icon(): NodeIcon
	{
		return $this->icon ?? new NodeIcon('box');
	}

	public function label(): NodeLabel
	{
		return $this->label ?? $this->name ?? NodeLabel::fallback($this->id);
	}

	public static function load(string|array $props): static
	{
		// load by path
		if (is_string($props) === true) {
			$props = static::loadProps($props);
		}

		// fix old extension paths
		if (isset($props['extends']) === true && is_string($props['extends']) === true) {
			$props['extends'] = static::polyfillPath($props['extends']);
		}

		return static::factory($props);
	}

	public static function polyfill(array $props): array
	{
		return Drawer::polyfill($props);
	}

	public static function polyfillPath(string|null $path = null): ?string
	{
		return match (true) {
			// no path, nothing to do
			$path === null => null,

			// always create the full path to the block
			str_starts_with($path, 'blocks/') === false => 'blocks/' . $path,

			// the path is already fine
			default => $path
		};
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'icon'  => $this->icon()->render($model),
			'id'    => $this->id,
			'label' => $this->label()->render($model),
		];
	}
}
