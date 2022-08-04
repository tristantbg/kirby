<?php

namespace Kirby\Option;

use Kirby\Cms\ModelWithContent;
use Kirby\Data\Json;
use Kirby\Foundation\Promise;
use Kirby\Http\Remote;
use Kirby\Http\Url;

/**
 * Options Api
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

	public function load(): array
	{
		if (Url::isAbsolute($this->url) === true) {
			return Remote::get($this->url)->json();
		}

		return Json::read($this->url);
	}

	public function resolve(ModelWithContent $model): Options
	{
		$result = $this->load();

		// TODO implement options for arrays, pages, etc.
		return new Options([]);
	}
}
