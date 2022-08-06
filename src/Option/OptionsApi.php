<?php

namespace Kirby\Option;

use Kirby\Blueprint\Promise;
use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Nest;
use Kirby\Data\Json;
use Kirby\Http\Remote;
use Kirby\Http\Url;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Query;

/**
 * Options from an API URL or local file
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class OptionsApi extends Promise
{
	public string $class = Options::class;
	public Options|null $options = null;

	public function __construct(
		public string $url,
		public string|null $query = null,
		public string|null $text = null,
		public string|null $value = null,
	) {
	}

	public static function factory(string|array $props): static
	{
		if (is_string($props) === true) {
			return new static(url: $props);
		}

		return new static(
			url: $props['url'],
			query: $props['query'] ?? $props['fetch'],
			text: $props['text'] ?? null,
			value: $props['value'] ?? null,
		);
	}

	/**
	 * Loads the API content from a remote URL
	 * or local file (or from cache)
	 */
	public function load(ModelWithContent $model): array
	{
		// resolve query templates in $this->url string
		$url = $model->toSafeString($this->url);

		// URL, request via cURL
		if (Url::isAbsolute($url) === true) {
			return Remote::get($url)->json();
		}

		// local file
		return Json::read($url);
	}

	/**
	 * Creates the actual options by loading
	 * data from the API and resolving it to
	 * the correct text-value entries
	 */
	public function resolve(ModelWithContent $model): Options
	{
		// use cached options if present
		if ($this->options !== null) {
			return $this->options;
		}

		// load data from URL
		$data = $this->load($model);

		// grab the relevant part, based on the query path
		$data = (new Query($this->query, Nest::create($data)))->result();

		// default query strings for text-value fields
		$text  = $this->text ?? '{{ item.value }}';
		$value = $this->value ?? '{{ item.key }}';

		// create options by resolving text and value query strings
		// for each item from the data
		$options = A::map($data, fn ($item) => [
			'text'  => $model->toSafeString($text, ['item' => $item]),
			'value' => $model->toSafeString($value, ['item' => $item]),
		]);

		// create Options object and render this subsequently
		return $this->options = Options::factory($options);
	}
}
