<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Value\BoolValue;

/**
 * Toggle field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ToggleField extends InputField
{
	public const TYPE = 'toggle';
	public BoolValue $value;

	public function __construct(
		public string $id,
		public FieldAfterText|null $after = null,
		public FieldBeforeText|null $before = null,
		public bool|null $default = null,
		public FieldIcon|null $icon = null,
		public ToggleFieldText|null $text = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new BoolValue;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'after'  => $this->after?->render($model),
			'before' => $this->before?->render($model),
			'icon'   => $this->icon?->render($model),
			'text'   => $this->text()->render($model),
		];
	}

	public function text(): ToggleFieldText
	{
		return $this->text ?? ToggleFieldText::default();
	}
}
