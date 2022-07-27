<?php

namespace Kirby\Blueprint;

use Kirby\Blueprint\Prop\SiteOptions;
use Kirby\Blueprint\Prop\Url;
use Kirby\Exception\NotFoundException;

/**
 * Site blueprint
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class SiteBlueprint extends Blueprint
{
	public const DEFAULT = 'site';
	public const TYPE    = 'site';

	public function __construct(
		public SiteOptions|null $options = null,
		public Url|null $preview = null,
		...$args
	) {
		parent::__construct('site', ...$args);
	}

	/**
	 * The site blueprint does not have a default
	 * fallback. An empty blueprint will have to do
	 */
	public static function default(): static
	{
		return new static;
	}

	public static function load(string $path = 'site'): static
	{
		if ($cached = static::cache()->get($path)) {
			return $cached;
		}

		try {
			$props = (new Config($path))->read();

			return static::cache()->set($path, static::factory($props));
		} catch (NotFoundException) {
			return static::default();
		}
	}

}
