<?php

namespace Kirby\Blueprint;

use Kirby\Toolkit\Str;

/**
 * Accept rules for uploaded files
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FileBlueprintAcceptRules
{
	public function __construct(
		public array|null $extensions = null,
		public int|null $maxheight = null,
		public int|null $maxsize = null,
		public int|null $maxwidth = null,
		public array|null $mimeTypes = null,
		public int|null $minheight = null,
		public int|null $minsize = null,
		public int|null $minwidth = null,
		public string|null $orientation = null,
		public array|null $types = null
	) {
	}

	public static function factory(string|array $accept = []): static
	{
		if (is_string($accept) === true) {
			$accept = ['mime' => $accept];
		}

		if (isset($accept['extension']) === true) {
			$accept['extensions'] ??= Str::split($accept['extension']);
			unset($accept['extension']);
		}

		if (isset($accept['mime']) === true) {
			$accept['mimeTypes'] ??= Str::split($accept['mime']);
			unset($accept['mime']);
		}

		if (isset($accept['type']) === true) {
			$accept['types'] ??= Str::split($accept['type']);
			unset($accept['type']);
		}

		return new static(...$accept);
	}
}
