<?php

namespace Kirby\Blueprint;

use Kirby\Architect\Inspector;
use Kirby\Architect\InspectorSection;
use Kirby\Architect\InspectorSections;
use Kirby\Cms\ModelWithContent;
use Kirby\Exception\NotFoundException;
use Kirby\Field\Fields;
use Kirby\Field\TextField;
use Kirby\Section\Section;
use Kirby\Section\Sections;

/**
 * Column
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Column extends Node
{
	public function __construct(
		public string $id,
		public Sections|null $sections = null,
		public ColumnWidth|null $width = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->sections ??= new Sections;
		$this->width    ??= new ColumnWidth;
	}

	public function fields(): Fields
	{
		return $this->sections()->fields();
	}

	public static function find(Blueprint|string $blueprintPath, Tab|string $tabId, Column|string $columnId): static
	{
		if (is_a($columnId, Column::class) === true) {
			return $columnId;
		}

		if ($column = Tab::find($blueprintPath, $tabId)->columns()->$columnId) {
			return $column;
		}

		throw new NotFoundException('The column "' . $columnId . '" could not be found');
	}

	public function inspector(): Inspector
	{
		$inspector = parent::inspector();
		$inspector->id = 'column';

		$settings = $inspector->sections->settings;
		$settings->width = ColumnWidth::field();

		return $inspector;
	}

	/**
	 * Columns can define fields without a proper
	 * wrapping fields section. The polyfill will
	 * automatically wrap the fields.
	 */
	public static function polyfill(array $props): array
	{
		$props = Polyfill::fields($props);
		return parent::polyfill($props);
	}

	public function render(ModelWithContent $model): array
	{
		$this->defaults();

		return [
			'sections' => $this->sections->render($model),
			'width'    => $this->width->render($model),
		];
	}

	public function section(string $id): ?Section
	{
		return $this->sections()->$id;
	}

	public function sections(): Sections
	{
		return $this->sections ?? new Sections();
	}

	public function width(): ColumnWidth
	{
		return $this->width ?? new ColumnWidth();
	}
}
