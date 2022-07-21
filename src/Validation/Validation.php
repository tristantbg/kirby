<?php

namespace Kirby\Validation;

use Closure;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Toolkit\I18n;

/**
 * Validation
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Validation
{
	/**
	 * Arguments will be passed to the handler
	 * on validation
	 */
	public array $args;

	/**
	 * Skip this validation when it is disabled
	 */
	public bool $disabled = false;

	/**
	 * A validation handler can either be the name of a V class
	 * validator or a custom handler callback
	 */
	public string|Closure $handler;

	/**
	 * Custom error message for the validation
	 */
	public string|null $message;

	public function __construct(
		string|Closure $handler,
		array $args = [],
		string|null $message = null,
		bool|Closure $disabled = false
	) {
		$this->args     = $args;
		$this->disabled = $disabled;
		$this->handler  = $handler;
		$this->message  = $message;
	}

	/**
	 * Validate the value with the set handler and arguments
	 */
	public function validate(mixed $value = null): bool
	{
		$disabled = $this->disabled;

		// resolve a lazy disabled state
		if (is_a($disabled, Closure::class) === true) {
			$disabled = $disabled($value);
		}

		if ($disabled === true) {
			return true;
		}

		$handler = $this->handler;

		// V class validator
		if (is_string($handler) === true) {
			$result   = V::$handler($value, ...$this->args);
			$message  = V::message($handler, $value, ...$this->args);

		// custom validator
		} else {
			$result  = $handler($value, ...$this->args);
			$message = 'error.validation.custom';
		}

		if ($result === true) {
			return true;
		}

		// build the custom message and try to translate it
		if ($customMessage = $this->message) {
			$message = I18n::translate($customMessage, $customMessage);
		}

		throw new InvalidArgumentException($message);
	}
}
