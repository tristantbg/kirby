<?php

namespace Kirby\Blueprint;

use Kirby\Blueprint\Prop\SiteOptions;
use Kirby\Blueprint\Prop\Url;

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
	public const TYPE = 'site';

	public function __construct(
		public SiteOptions|null $options = null,
		public Url|null $preview = null,
		...$args
	) {
		parent::__construct('site', ...$args);
	}

	public static function load(): static
	{
		$config = new Config('site');

		return static::factory($config->read());
	}

	/**
	 * The id is fixed and not available
	 * as property
	 */
	public static function polyfill(array $props): array
	{
		unset($props['id']);

		return parent::polyfill($props);
	}
}
