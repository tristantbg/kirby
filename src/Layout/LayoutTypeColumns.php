<?php

namespace Kirby\Layout;

use Kirby\Blueprint\Collection;
use Kirby\Cms\ModelWithContent;
use Kirby\Layout\LayoutWidth;

/**
 * Layout Type Columns
 *
 * @package   Kirby Layout
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class LayoutTypeColumns extends Collection
{
	public const TYPE = LayoutWidth::class;

	public function __construct(array $widths = [])
	{
		foreach ($widths as $index => $width) {
			$this->__set($index, $width);
		}
	}

	public function render(ModelWithContent $model): array
	{
		$widths = array_map(function ($width) {
			return $width->value;
		}, $this->data);

		return array_values($widths);
	}
}
