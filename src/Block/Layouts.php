<?php

namespace Kirby\Block;

use Kirby\Data\Data;
use Kirby\Toolkit\Str;
use Throwable;

/**
 * A collection of layouts
 * @since 3.5.0
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://getkirby.com/license
 */
class Layouts extends Items
{
	public const ITEM_CLASS = '\Kirby\Block\Layout';

	public static function factory(array $items = null, array $params = []): static
	{
		$first = $items[0] ?? [];

		// if there are no wrapping layouts for blocks yet …
		if (array_key_exists('content', $first) === true || array_key_exists('type', $first) === true) {
			$items = [
				[
					'id'      => Str::uuid(),
					'columns' => [
						[
							'width'  => '1/1',
							'blocks' => $items
						]
					]
				]
			];
		}

		return parent::factory($items, $params);
	}

	/**
	 * Checks if a given block type exists in the layouts collection
	 * @since 3.6.0
	 */
	public function hasBlockType(string $type): bool
	{
		return $this->toBlocks()->hasType($type);
	}

	/**
	 * Parse layouts data
	 */
	public static function parse(array|string|null $input): array
	{
		if (empty($input) === false && is_array($input) === false) {
			try {
				$input = Data::decode($input, 'json');
			} catch (Throwable $e) {
				return [];
			}
		}

		if (empty($input) === true) {
			return [];
		}

		return $input;
	}

	/**
	 * Converts layouts to blocks
	 * @since 3.6.0
	 *
	 * @param bool $includeHidden Sets whether to include hidden blocks
	 */
	public function toBlocks(bool $includeHidden = false): Blocks
	{
		$blocks = [];

		if ($this->isNotEmpty() === true) {
			foreach ($this->data() as $layout) {
				foreach ($layout->columns() as $column) {
					foreach ($column->blocks($includeHidden) as $block) {
						$blocks[] = $block->toArray();
					}
				}
			}
		}

		return Blocks::factory($blocks);
	}
}
