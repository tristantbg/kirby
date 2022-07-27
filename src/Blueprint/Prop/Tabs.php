<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Cms\ModelWithContent;
use Kirby\Field\Fields;
use Kirby\Foundation\Nodes;
use Kirby\Section\Sections;

/**
 * Tabs
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Tabs extends Nodes
{
	public const TYPE = Tab::class;

	/**
	 * Collect all columns in all tabs
	 */
	public function columns(): Columns
	{
		$columns = new Columns;

		foreach ($this->data as $tab) {
			foreach ($tab->columns ?? [] as $column) {
				$columns->__set($tab->id . '/' . $column->id, $column);
			}
		}

		return $columns;
	}

	/**
	 * Collect all fields in all tabs
	 */
	public function fields(): Fields
	{
		return $this->sections()->fields();
	}

	public function render(ModelWithContent $model): mixed
	{
		return array_values(parent::render($model));
	}

	/**
	 * Collect all sections in all tabs
	 */
	public function sections(): Sections
	{
		return $this->columns()->sections();
	}
}
