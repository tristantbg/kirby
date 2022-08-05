<?php

namespace Kirby\Option;

use Kirby\Blueprint\Collection;
use Kirby\Cms\ModelWithContent;

/**
 * Options
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Options extends Collection
{
	public const TYPE = Option::class;

	public function __construct(array $objects = [])
	{
		foreach ($objects as $object) {
			$this->__set($object->value, $object);
		}
	}

	public static function factory(array $options = []): static
	{
		$collection = new static;

		foreach ($options as $key => $option) {
			if (is_string($option) === true) {
				if (is_string($key) === true) {
					$option = ['value' => $key, 'text' => $option];
				} else {
					$option = ['value' => $option];
				}
			}

			$option = Option::factory($option);
			$collection->__set($option->value, $option);
		}

		return $collection;
	}

	public function render(ModelWithContent $model): mixed
	{
		return array_values(parent::render($model));
	}
}
