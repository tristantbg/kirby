<?php

namespace Kirby\Blueprint;

use Kirby\Attribute\UrlAttribute;
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

	public function __construct(
		public SiteBlueprintOptions|null $options = null,
		public UrlAttribute|null $preview = null,
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

	public function options(): SiteBlueprintOptions
	{
		return $this->options ?? new SiteBlueprintOptions;
	}

	public static function polyfill(array $props): array
	{
		unset($props['id']);

		return parent::polyfill($props);
	}

	public static function load(string|array $props = 'site'): static
	{
		try {
			return static::loadInstance($props);
		} catch (NotFoundException) {
			return static::default();
		}
	}
}
