<?php

namespace Kirby\Block;

use Kirby\Cms\App;
use Kirby\Cms\HasSiblings;
use Kirby\Cms\ModelWithContent;
use Kirby\Toolkit\Str;

/**
 * The Item class is the foundation
 * for every object in context with
 * other objects. I.e.
 *
 * - a Block in a collection of Blocks
 * - a Layout in a collection of Layouts
 * - a Column in a collection of Columns
 * @since 3.5.0
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://getkirby.com/license
 */
class Item
{
	use HasSiblings;

	public const ITEMS_CLASS = '\Kirby\Block\Items';

	protected string $id;
	protected array $params;
	protected ModelWithContent $parent;
	protected Items $siblings;

	/**
	 * Creates a new item
	 */
	public function __construct(array $params = [])
	{
		$siblingsClass = static::ITEMS_CLASS;

		$this->id       = $params['id']       ?? Str::uuid();
		$this->params   = $params;
		$this->parent   = $params['parent']   ?? App::instance()->site();
		$this->siblings = $params['siblings'] ?? new $siblingsClass();
	}

	/**
	 * Static Item factory
	 */
	public static function factory(array $params): static
	{
		return new static($params);
	}

	/**
	 * Returns the unique item id (UUID v4)
	 */
	public function id(): string
	{
		return $this->id;
	}

	/**
	 * Compares the item to another one
	 */
	public function is(Item $item): bool
	{
		return $this->id() === $item->id();
	}

	/**
	 * Returns the Kirby instance
	 */
	public function kirby(): App
	{
		return $this->parent()->kirby();
	}

	/**
	 * Returns the parent model
	 */
	public function parent(): ModelWithContent
	{
		return $this->parent;
	}

	/**
	 * Returns the sibling collection
	 * This is required by the HasSiblings trait
	 *
	 * @psalm-return self::ITEMS_CLASS
	 */
	protected function siblingsCollection(): Items
	{
		return $this->siblings;
	}

	/**
	 * Converts the item to an array
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id(),
		];
	}
}
