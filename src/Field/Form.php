<?php

namespace Kirby\Field;

use Kirby\Foundation\Component;
use Kirby\Value\Values;

/**
 * Form
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Form extends Component
{
	public function __construct(
		public Fields $fields,
	) {
	}

	public function fill(array $values = [], bool $defaults = false): static
	{
		$this->fields->fill($values, $defaults);
		return $this;
	}

	public function submit(array $values = []): static
	{
		$this->fields->active()->submit($values);
		return $this;
	}

	public function values(): Values
	{
		return $this->fields->active()->export();
	}
}
