<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Exception\NotFoundException;
use Kirby\Field\Fields;
use Kirby\Section\Section;
use Kirby\Section\Sections;
use Kirby\Toolkit\Str;

/**
 * The main blueprint class
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Blueprint extends NodeLabelled
{
	public const DEFAULT = 'default';
	public const TYPE = 'blueprint';

	public static Cache $cache;
	public ModelWithContent|null $model = null;

	public function __construct(
		public string $id,
		public Tabs|null $tabs = null,
		...$args
	) {
		parent::__construct($id, ...$args);
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
		return static::$cache ??= new Cache();
	}

	public static function class(string $type): string
	{
		return __NAMESPACE__ . '\\' . ucfirst(rtrim($type, 's')) . 'Blueprint';
	}

	/**
	 * Collects all columns from all tabs
	 */
	public function columns(): Columns
	{
		return $this->tabs()->columns();
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

	public static function factory(array $props): static
	{
		$props = static::polyfill($props);
		return parent::factory($props);
	}

	/**
	 * Collects all fields from all tabs
	 */
	public function fields(): Fields
	{
		return $this->sections()->fields();
	}

	public static function find(Blueprint|string $blueprintPath): static
	{
		if (is_a($blueprintPath, Blueprint::class) === true) {
			return $blueprintPath;
		}

		$blueprintPath = str_replace(['+', ' '], '/', $blueprintPath);
		$blueprintType = $blueprintPath === 'site' ? 'site' : Str::before($blueprintPath, '/');

		return static::class($blueprintType)::loadInstance($blueprintPath);
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

	public function options(): BlueprintOptions
	{
		$this->defaults();
		return $this->options;
	}

	public function path(): string
	{
		return $this->id;
	}

	/**
	 * The polyfill method takes care of all the
	 * blueprint shortcuts: i.e. fields without
	 * a wrapping section, columns without a tab etc.
	 */
	public static function polyfill(array $props): array
	{
		$props = Polyfill::title($props);
		$props = Polyfill::icon($props);
		$props = Polyfill::fields($props);
		$props = Polyfill::sections($props);
		$props = Polyfill::columns($props);

		return $props;
	}

	public function render(ModelWithContent $model, string $tab = null): array
	{
		return [
			'label' => $this->label()->render($model),
			'tabs'  => $this->tabs()->render($model),
			'tab'   => $this->tab($tab)?->render($model, true)
		];
	}

	/**
	 * Finds a section by id
	 */
	public function section(string $id = null): ?Section
	{
		return $this->sections()->$id;
	}

	/**
	 * Collects all sections from all tabs
	 */
	public function sections(): Sections
	{
		return $this->columns()->sections();
	}

	/**
	 * Finds a tab by id
	 */
	public function tab(string $id = null): ?Tab
	{
		// no tab id -> take first tab
		if ($id === null) {
			return $this->tabs()->first();
		}

		return $this->tabs()->$id;
	}

	public function tabs(): Tabs
	{
		return $this->tabs ?? new Tabs();
	}

	/**
	 * @deprecated 3.9.0
	 */
	public function title(): ?string
	{
		return $this->label?->render($this->model);
	}

}
