<?php

namespace Kirby\Table;

use Kirby\Blueprint\NodeLabelled;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Field;
use Kirby\Field\FieldAfterText;
use Kirby\Field\FieldBeforeText;
use Kirby\Field\TextField;

/**
 * Table column
 *
 * @package   Kirby Table
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TableColumn extends NodeLabelled
{
	public function __construct(
		public string $id,
		public FieldAfterText|null $after = null,
		public TableColumnAlign|null $align = null,
		public FieldBeforeText|null $before = null,
		public Field|null $field = null,
		public bool $mobile = false,
		public string|null $value = null,
		public string|null $width = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->align ??= new TableColumnAlign;
		$this->field ??= new TextField($this->id);

		parent::defaults();
	}

	public static function factory(array $props = []): static
	{
		// convert a simple string type to a field definition
		if (isset($props['type']) === true) {
			$props['field'] ??= [
				'type' => $props['type']
			];

			unset($props['type']);
		}

		// make sure that the id has a field and the correct type
		if (isset($props['field']) === true) {
			$props['field']['id']   ??= $props['id'];
			$props['field']['type'] ??= 'text';

			// create the field instance
			$props['field'] = Field::load($props['field']);
		}

		return parent::factory($props);
	}

	public function render(ModelWithContent $model): array
	{
		$this->defaults();

		return [
			'align'  => $this->align->render($model),
			'id'     => $this->id,
			'label'  => $this->label->render($model),
			'mobile' => $this->mobile,
			'type'   => $this->field::TYPE,
		];
	}

	/**
	 * The value method helps to create cell values
	 * for this column, by passing in a parent model
	 * and the raw value.
	 */
	public function value(ModelWithContent $model, mixed $value = null)
	{
		// apply all defaults
		$this->defaults();

		// if the column has a fixed value
		// the value is evaluated, by parsing it
		// as template string
		if ($this->value) {
			$value = $model->toSafeString($this->value);
		}

		// the field's value method is used to render
		// the correct value for the cell, which can
		// then be picked up by the Vue cell component
		// to render the value correctly
		return $this->field->value?->set($value)->render($model);
	}

}
