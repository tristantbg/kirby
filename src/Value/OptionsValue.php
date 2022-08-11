<?php

namespace Kirby\Value;

use Closure;
use Kirby\Cms\ModelWithContent;
use Kirby\Toolkit\Str;

/**
 * Options Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class OptionsValue extends ArrayValue
{
	public function __construct(
		public array|Closure|null $allowed = null,
		public string $separator = ',',
		...$args
	) {
		parent::__construct(...$args);

		// check for allowed options
		$this->validations->add('allowed', function (array $values, ModelWithContent|null $model = null) {
			$options = $this->allowed;

			// resolvable options
			if (is_a($options, Closure::class) === true) {
				$options = $options($model);
			}

			// allow any option
			if (is_array($options) === false) {
				return true;
			}

			// compare with options in the value array
			foreach ($values as $value) {
				if (in_array($value, $options, true) === false) {
					return false;
				}
			}

			return true;
		}, 'error.validation.option');
	}

	public function __toString(): string
	{
		return join($this->separator, $this->data ?? []);
	}

	public function set(string|array|null $data = null): static
	{
		if (is_string($data) === true) {
			$data = Str::split($data, $this->separator);
		}

		$this->data = $data;
		return $this;
	}
}
