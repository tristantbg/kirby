<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Toolkit\I18n;

/**
 * Translatable blueprint node
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeI18n extends NodeofKind
{
	public function __construct(
		public array $translations,
	) {
	}

	public static function factory($translations = null): ?static
	{
		if (is_null($translations) === true) {
			return null;
		}

		if (is_string($translations) === true) {
			$translations = ['*' => $translations];
		}

		return new static($translations);
	}

	public function render(ModelWithContent $model): ?string
	{
		$locale = I18n::locale();

		if (isset($this->translations[$locale]) === true) {
			return $this->translations[$locale];
		}

		if (isset($this->translations['*']) === true) {
			$translations = $this->translations['*'];
			return I18n::translation($locale)[$translations] ?? $translations;
		}

		return $this->translations['en'] ?? null;
	}
}
