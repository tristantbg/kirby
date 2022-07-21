<?php

namespace Kirby\Value;

/**
 * Url Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class UrlValue extends StringValue
{
	public function __construct(
		...$args
	) {
		parent::__construct(...$args);

		$this->validations->add('url');
	}
}
