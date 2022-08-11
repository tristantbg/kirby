<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Value\Value;

/**
 * Base class for all saveable fields
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class InputField extends DisplayField
{
	public const TYPE = 'input';

	public function __construct(
		public string $id,
		public bool $autofocus = false,
		public bool $disabled = false,
		public bool $required = false,
		public bool $translate = true,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function fill(mixed $value = null, bool $default = false): static
	{
		// default as fallback for empty values
		if (
			$default === true &&
			property_exists($this, 'default') === true
		) {
			$value ??= $this->default;
		}

		$this->value->set($value);
		return $this;
	}

	public function isInput(): bool
	{
		return true;
	}

	public function isActive(array $values = []): bool
	{
		if ($this->disabled === true) {
			return false;
		}

		return parent::isActive($values);
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'autofocus' => $this->autofocus,
			'disabled'  => $this->disabled,
			'required'  => $this->required,
		];
	}

	public function submit(
		mixed $value = null,
		ModelWithContent|null $model = null
	): static {
		if ($this->disabled === true) {
			return $this;
		}

		$this->value->submit($value);
		return $this;
	}
}
