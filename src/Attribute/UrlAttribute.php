<?php

namespace Kirby\Attribute;

use Kirby\Cms\ModelWithContent;

/**
 * Url option with query string superpowers
 *
 * @package   Kirby Attribute
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class UrlAttribute extends StringAttribute
{
	public function __construct(
		public string $value
	) {
	}

	public function render(ModelWithContent $model): string
	{
		return $model->toSafeString($this->value);
	}
}
