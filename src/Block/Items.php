<?php

namespace Kirby\Block;

use Closure;
use Exception;
use Kirby\Cms\App;
use Kirby\Cms\Collection;
use Kirby\Cms\ModelWithContent;

/**
 * A collection of items
 * @since 3.5.0
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://getkirby.com/license
 */
class Items extends Collection
{
	public const ITEM_CLASS = '\Kirby\Block\Item';

	protected array $options;

	/**
	 * @var \Kirby\Cms\ModelWithContent
	 */
	protected $parent;

	/**
	 * Constructor
	 */
	public function __construct(array $objects = [], array $options = [])
	{
		$this->options = $options;
		$this->parent  = $options['parent'] ?? App::instance()->site();

		parent::__construct($objects, $this->parent);
	}

	/**
	 * Creates a new item collection from a
	 * an array of item props
	 */
	public static function factory(array $items = null, array $params = []): static
	{
		$options = array_merge([
			'options' => [],
			'parent'  => App::instance()->site(),
		], $params);

		if (empty($items) === true || is_array($items) === false) {
			return new static();
		}

		if (is_array($options) === false) {
			throw new Exception('Invalid item options');
		}

		// create a new collection of blocks
		$collection = new static([], $options);

		foreach ($items as $params) {
			if (is_array($params) === false) {
				continue;
			}

			$params['options']  = $options['options'];
			$params['parent']   = $options['parent'];
			$params['siblings'] = $collection;
			$class = static::ITEM_CLASS;
			$item  = $class::factory($params);
			$collection->append($item->id(), $item);
		}

		return $collection;
	}

	/**
	 * Convert the items to an array
	 */
	public function toArray(Closure|null $map = null): array
	{
		return array_values(parent::toArray($map));
	}
}
