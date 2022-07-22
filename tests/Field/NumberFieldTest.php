<?php

namespace Kirby\Field;

use Kirby\Value\NumberValue;

/**
 * @covers \Kirby\Field\NumberField
 */
class NumberFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new NumberField(
			id: 'test',
		);

		$this->assertSame('test', $field->id);
		$this->assertNull($field->after);
		$this->assertNull($field->autocomplete);
		$this->assertNull($field->before);
		$this->assertNull($field->default);
		$this->assertNull($field->icon);
		$this->assertNull($field->max);
		$this->assertNull($field->min);
		$this->assertNull($field->placeholder);
		$this->assertNull($field->step);
		$this->assertInstanceOf(NumberValue::class, $field->value);
	}
}
