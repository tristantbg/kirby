<?php

namespace Kirby\Block;

use Kirby\Data\Json;
use Kirby\Parsley\Parsley;
use Kirby\Parsley\Schema\Blocks as BlockSchema;
use Kirby\Toolkit\Str;
use Throwable;

/**
 * A collection of blocks
 * @since 3.5.0
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://getkirby.com/license
 */
class Blocks extends Items
{
	public const ITEM_CLASS = '\Kirby\Block\Block';

	/**
	 * Return HTML when the collection is
	 * converted to a string
	 */
	public function __toString(): string
	{
		return $this->toHtml();
	}

	/**
	 * Converts the blocks to HTML and then
	 * uses the Str::excerpt method to create
	 * a non-formatted, shortened excerpt from it
	 */
	public function excerpt(...$args): string
	{
		return Str::excerpt($this->toHtml(), ...$args);
	}

	/**
	 * Wrapper around the factory to
	 * catch blocks from layouts
	 */
	public static function factory(array $items = null, array $params = []): static
	{
		$items = static::extractFromLayouts($items);

		return parent::factory($items, $params);
	}

	/**
	 * Pull out blocks from layouts
	 */
	protected static function extractFromLayouts(array $input): array
	{
		if (empty($input) === true) {
			return [];
		}

		// no columns = no layout
		if (array_key_exists('columns', $input[0]) === false) {
			return $input;
		}

		$blocks = [];

		foreach ($input as $layout) {
			foreach (($layout['columns'] ?? []) as $column) {
				foreach (($column['blocks'] ?? []) as $block) {
					$blocks[] = $block;
				}
			}
		}

		return $blocks;
	}

	/**
	 * Checks if a given block type exists in the collection
	 * @since 3.6.0
	 */
	public function hasType(string $type): bool
	{
		return $this->filterBy('type', $type)->count() > 0;
	}

	/**
	 * Parse and sanitize various block formats
	 */
	public static function parse(array|string|null $input): array
	{
		if (empty($input) === false && is_array($input) === false) {
			try {
				$input = Json::decode((string)$input);
			} catch (Throwable $e) {
				$parser = new Parsley((string)$input, new BlockSchema());
				$input  = $parser->blocks();
			}
		}

		if (empty($input) === true) {
			return [];
		}

		return $input;
	}

	/**
	 * Convert all blocks to HTML
	 */
	public function toHtml(): string
	{
		$html = [];

		foreach ($this->data as $block) {
			$html[] = $block->toHtml();
		}

		return implode($html);
	}
}
