<?php

namespace Kirby\Option;

use Kirby\Blueprint\Promise;
use Kirby\Cms\Block;
use Kirby\Cms\File;
use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Page;
use Kirby\Cms\StructureObject;
use Kirby\Cms\User;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Toolkit\Obj;

/**
 * Options from a Kirby query string
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class OptionsQuery extends Promise
{
	public string $class = Options::class;
	public Options|null $options = null;

	public function __construct(
		public string $query,
		public string|null $text = null,
		public string|null $value = null,
	) {
	}

	public static function factory(string|array $props): static
	{
		if (is_string($props) === true) {
			return new static(query: $props);
		}

		return new static(
			query: $props['query'] ?? $props['fetch'],
			text: $props['text'] ?? null,
			value: $props['value'] ?? null,
		);
	}

	/**
	 * Returns defaults for the following based on item type:
	 * [query entry alias, default text query, default value query]
	 */
	protected function itemToDefaults(object $item): array
	{
		return match (true) {
			is_a($item, Obj::class) === true
				=> [
					'arrayItem',
					'{{ arrayItem.value }}',
					'{{ arrayItem.value }}'
				],

			is_a($item, StructureObject::class) === true
				=> [
					'structureItem',
					'{{ structureItem.title }}',
					'{{ structureItem.id }}'
				],

			is_a($item, Block::class) === true
				=> [
					'block',
					'{{ block.type }}: {{ block.id }}',
					'{{ block.id }}'
				],

			is_a($item, Page::class) === true
				=> [
					'page',
					'{{ page.title }}',
					'{{ page.id }}'
				],

			is_a($item, File::class) === true
				=> [
					'file',
					'{{ file.filename }}',
					'{{ file.id }}'
				],

			is_a($item, User::class) === true
				=> [
					'user',
					'{{ user.username }}',
					'{{ user.email }}'
				],

			default => [
				'item',
				'{{ item.value }}',
				'{{ item.value }}'
			]
		};
	}

	/**
	 * Creates the actual options by running
	 * the query on the model and resolving it to
	 * the correct text-value entries
	 */
	public function resolve(ModelWithContent $model): Options
	{
		// use cached options if present
		// @codeCoverageIgnoreStart
		if ($this->options !== null) {
			return $this->options;
		}
		// @codeCoverageIgnoreEnd

		// run query
		$result = $model->query($this->query);

		// the query already returned an options collection
		if (is_a($result, Options::class) === true) {
			return $result;
		}

		// convert result to a collection
		if (is_array($result) === true) {
			$result = Nest::create($result);
		}

		if (is_a($result, 'Kirby\Toolkit\Collection') === false) {
			throw new InvalidArgumentException('Invalid query result data: ' . get_class($result));
		}

		// create options array
		$options = $result->toArray(function ($item) use ($model) {
			// get defaults based on item type
			[$alias, $text, $value] = $this->itemToDefaults($item);
			$data = ['item' => $item, $alias => $item];

			return [
				'text'  => $model->toSafeString($this->text ?? $text, $data),
				'value' => $model->toSafeString($this->value ?? $value, $data),
			];
		});

		return $this->options = Options::factory($options);
	}
}
