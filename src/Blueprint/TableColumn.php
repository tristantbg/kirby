<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

class TableColumn extends Node
{
	public function __construct(
		public string $id,
		public TextAlign|null $align = null,
		public Field|null $field = null,
		public Label|null $label = null,
		public bool $mobile = false,
		public string|null $value = null,
		public string|null $width = null
	) {
		$this->label ??= Label::fallback($id);
	}

	/**
	 * Returns the field object for the
	 * column. If no field is specified,
	 * a regular Text field will be used
	 */
	public function field(): Field
	{
		return $this->field ?? new TextField($this->id);
	}

	/**
	 * The value method helps to create cell values
	 * for this column, by passing in a parent model
	 * and the raw value.
	 *
	 * @param ModelWithContent $model
	 * @param mixed $value
	 * @return void
	 */
	public function value(ModelWithContent $model, mixed $value = null)
	{
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
		return $this->field->value($model, $value);
	}

}
