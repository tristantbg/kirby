<?php

namespace Kirby\Value;

use Closure;
use Kirby\Cms\ModelWithContent;

/**
 * Option Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class OptionValue extends MixedValue
{
	public function __construct(
		public array|Closure|null $allowed = null,
		...$args
	) {
		parent::__construct(...$args);

		// check for allowed options
		$this->validations->add('allowed', function (mixed $value, ModelWithContent|null $model = null) {
			$options = $this->allowed;

			// resolvable options
			if (is_a($options, Closure::class) === true) {
				$options = $options($model);
			}

			// allow any option
			if (is_array($options) === false) {
				return true;
			}

			return in_array($value, $options, true) === true;
		}, 'error.validation.option');
	}
}
