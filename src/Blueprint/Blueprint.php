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
	public const GROUP   = 'blueprint';
	public const TYPE    = 'blueprint';

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

	/**
	 * Binds a model to a blueprint. This pattern should
	 * be avoided and is mostly here to get deprecated
	 * features working.
	 */
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

	/**
	 * Loads the default blueprint and falls back
	 * to a generic placeholder blueprint without
	 * any setup
	 */
	public static function default(): static
	{
		try {
			return static::loadInstance(static::DEFAULT);
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

	/**
	 * Loads a blueprint either by path or by
	 * an array of props. The default blueprint
	 * will be returned if it cannot be found
	 */
	public static function load(string|array $props): static
	{
		try {
			return static::loadInstance($props);
		} catch (NotFoundException) {
			return static::default();
		}
	}

	/**
	 * The load and default methods both have the
	 * same try/catch statement. This method is just
	 * a helper to avoid redundancy within those methods.
	 */
	public static function loadInstance(string|array $props): static
	{
		if (is_string($props) === true) {
			$props = static::loadProps($props);
		}

		return static::factory($props);
	}

	/**
	 * The polyfill method takes care of all the
	 * blueprint shortcuts: i.e. fields without
	 * a wrapping section, columns without a tab etc.
	 */
	public static function polyfill(array $props): array
	{
		$props = static::polyfillTitle($props);
		$props = static::polyfillIcon($props);
		$props = static::polyfillFields($props);
		$props = static::polyfillSections($props);
		$props = static::polyfillColumns($props);

		return $props;
	}

	/**
	 * Creates a wrapping tab when only columns are
	 * defined in the blueprint as a shortcut
	 */
	public static function polyfillColumns(array $props, string $tabId = 'content'): array
	{
		if (isset($props['columns']) === true) {
			$props['tabs'] = [
				$tabId => [
					'columns' => $props['columns']
				]
			];

			unset($props['columns']);
		}

		return $props;
	}

	/**
	 * Creates a wrapping fields section for stand-alone fields
	 */
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

	/**
	 * Converts the simplified icon method to a full
	 * image option definition
	 */
	public static function polyfillIcon(array $props): array
	{
		// move icon definition into image
		if (isset($props['icon']) === true) {
			$props['image']['icon'] = $props['icon'];
			unset($props['icon']);
		}

		return $props;
	}

	/**
	 * Creates a wrapping column around stand-alone sections
	 */
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

	/**
	 * Keeps the old `title:` option working by
	 * converting it to the new unified `label:` option
	 */
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

	/**
	 * Finds a section by id
	 */
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
	 * Finds a tab by id
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
