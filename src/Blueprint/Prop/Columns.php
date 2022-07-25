<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Field\Fields;
use Kirby\Foundation\Nodes;
use Kirby\Section\Sections;

/**
 * Columns
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Columns extends Nodes
{
	public const TYPE = Column::class;

	/**
	 * Collect all fields in all columns
	 */
	public function fields(): Fields
	{
		return $this->sections()->fields();
	}

	/**
	 * Collect all sections in all columns
	 */
	public function sections(): Sections
	{
		$sections = new Sections;

		foreach ($this->data as $column) {
			foreach ($column->sections ?? [] as $section) {
				$sections->__set($section->id, $section);
			}
		}

		return $sections;
	}
}
