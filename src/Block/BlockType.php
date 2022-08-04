<?php

namespace Kirby\Block;

use Kirby\Attribute\IconAttribute;
use Kirby\Attribute\LabelAttribute;
use Kirby\Cms\ModelWithContent;
use Kirby\Drawer\Drawer;
use Kirby\Drawer\DrawerTabs;
use Kirby\Field\Fields;
use Kirby\Node\LabelledNode;

/**
 * Block type
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlockType extends LabelledNode
{
	public function __construct(
		public string $id,
		public bool $disabled = false,
		public bool $editable = true,
		public IconAttribute|null $icon = null,
		public LabelAttribute|null $name = null,
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

	public function icon(): IconAttribute
	{
		return $this->icon ?? new IconAttribute('box');
	}

	public function label(): LabelAttribute
	{
		return $this->label ?? $this->name ?? LabelAttribute::fallback($this->id);
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
