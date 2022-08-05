<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Enumeration\ColumnWidth;
use Kirby\Field\Fields;
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

	public function fields(): Fields
	{
		return $this->sections()->fields();
	}

	/**
	 * Columns can define fields without a proper
	 * wrapping fields section. The polyfill will
	 * automatically wrap the fields.
	 */
	public static function polyfill(array $props): array
	{
		return parent::polyfill(Polyfill::fields($props));
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'sections' => $this->sections()->render($model),
			'width'    => $this->width()->render($model),
		];
	}

	public function sections(): Sections
	{
		return $this->sections ?? new Sections;
	}

	public function width(): ColumnWidth
	{
		return $this->width ?? new ColumnWidth;
	}
}
