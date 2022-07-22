<?php

namespace Kirby\Field;

use Kirby\Value\OptionsValue;

/**
 * @covers \Kirby\Field\CheckboxesField
 */
class CheckboxesFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new CheckboxesField('test');

		$this->assertInstanceOf(OptionsField::class, $field);
		$this->assertSame(1, $field->columns);
		$this->assertInstanceOf(OptionsValue::class, $field->value);
	}
}
