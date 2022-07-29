<?php

namespace Kirby\Blueprint;

use Kirby\Blueprint\Prop\Columns;
use Kirby\Blueprint\Prop\Label;
use Kirby\Blueprint\Prop\Tab;
use Kirby\Blueprint\Prop\Tabs;
use Kirby\Cms\ModelWithContent;
use Kirby\Exception\NotFoundException;
use Kirby\Field\Fields;
use Kirby\Foundation\NodeWithType;
use Kirby\Section\Section;
use Kirby\Section\Sections;

/**
 * The main blueprint class
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Blueprint extends NodeWithType
{
	public const DEFAULT = 'default';
	public const TYPE = 'blueprint';

	public static Cache $cache;
	public ModelWithContent|null $model = null;

	public function __construct(
		public string $id,
		public Extension|null $extends = null,
		public Label|null $label = null,
		public Tabs|null $tabs = null,
	) {
		$this->defaults();
	}

	public function bind(ModelWithContent $model): static
	{
		$this->model = $model;
		return $this;
	}

	public static function cache(): Cache
	{
		return static::$cache ??= new Cache;
	}

	/**
	 * Collects all columns from all tabs
	 */
	public function columns(): ?Columns
	{
		return $this->tabs?->columns();
	}

	public static function default(): static
	{
		if ($cached = static::cache()->get(static::DEFAULT)) {
			return $cached;
		}

		try {
			$config = new Config(static::DEFAULT);
			$props  = $config->read();

			$props['id'] = 'default';

			return static::cache()->set(static::DEFAULT, static::factory($props));
		} catch (NotFoundException) {
			return new static(id: 'default');
		}
	}

	public function defaults(): void
	{
		$this->label ??= Label::fallback($this->id);
	}

	public static function factory(array $props): static
	{
		return parent::factory(static::polyfill($props));
	}

	/**
	 * Collects all fields from all tabs
	 */
	public function fields(): ?Fields
	{
		return $this->sections()?->fields();
	}

	public static function load(string $path): static
	{
		if ($cached = static::cache()->get($path)) {
			return $cached;
		}

		try {
			$config = new Config($path);
			$props  = $config->read();

			// add the id if it's not there yet
			$props['id'] ??= basename($path);

			return static::cache()->set($path, static::factory($props));
		} catch (NotFoundException) {
			return static::default();
		}
	}

	public static function polyfill(array $props): array
	{
		$props = static::polyfillTitle($props);
		$props = static::polyfillIcon($props);
		$props = static::polyfillFields($props);
		$props = static::polyfillSections($props);
		$props = static::polyfillColumns($props);

		return $props;
	}

	public static function polyfillColumns(array $props, string $tabId = 'content'): array
	{
		if (isset($props['columns']) === true) {
			// create a new wrapping tab
			$props['tabs'] = [
				$tabId => [
					'columns' => $props['columns']
				]
			];

			unset($props['columns']);
		}

		return $props;
	}

	public static function polyfillFields(array $props, string $sectionId = null): array
	{
		// fields shortcut
		if (isset($props['fields']) === true) {
			$sectionId ??= implode('-', array_keys($props['fields']));

			// create a new wrapping content section
			$props['sections'] = [
				$sectionId => [
					'type'   => 'fields',
					'fields' => $props['fields']
				]
			];

			unset($props['fields']);
		}

		return $props;
	}

	public static function polyfillIcon(array $props): array
	{
		// move icon definition into image
		if (isset($props['icon']) === true) {
			$props['image']['icon'] = $props['icon'];
			unset($props['icon']);
		}

		return $props;
	}

	public static function polyfillSections(array $props): array
	{
		// sections shortcut
		if (isset($props['sections']) === true) {
			// create a new wrapping column
			$props['columns'] = [
				[
					'sections' => $props['sections']
				]
			];

			unset($props['sections']);
		}

		return $props;
	}

	public static function polyfillTitle(array $props): array
	{
		// make old title option compatible
		if (isset($props['title']) === true) {
			$props['label'] = $props['title'];
			unset($props['title']);
		}

		return $props;
	}

	public function render(ModelWithContent $model, string $tab = null): array
	{
		return [
			'label' => $this->label->render($model),
			'tabs'  => $this->tabs?->render($model),
			'tab'   => $this->tab($tab)?->render($model, true)
		];
	}

	public function section(string $id = null): ?Section
	{
		return $this->sections()?->$id;
	}

	/**
	 * Collects all sections from all tabs
	 */
	public function sections(): ?Sections
	{
		return $this->columns()?->sections();
	}

	/**
	 * Get the current tab by id
	 */
	public function tab(string $id = null): ?Tab
	{
		// the blueprint might not have any tabs
		if ($this->tabs === null || $this->tabs->count() === 0) {
			return null;
		}

		// no tab id -> take first tab
		if ($id === null) {
			return $this->tabs->first();
		}

		// find tab by id
		if ($tab = $this->tabs?->$id) {
			return $tab;
		}

		throw new NotFoundException('The tab could not be found');
	}

	/**
	 * @deprecated 3.9.0
	 */
	public function title(): ?string
	{
		return $this->label?->render($this->model);
	}

}
