<?php

namespace Kirby\Option;

use Kirby\Blueprint\Promise;
use Kirby\Cms\ModelWithContent;

/**
 * Options Query
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

	public function resolve(ModelWithContent $model): Options
	{
		$result = $model->query($this->query);

		// the query already returned an options collection
		if (is_a($result, Options::class) === true) {
			return $result;
		}

		// TODO implement options for arrays, pages, etc.
		return new Options([]);
	}
}
