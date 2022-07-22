<?php

namespace Kirby\Field;

/**
 * @covers \Kirby\Field\SelectField
 */
class SelectFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new SelectField('test');

		$this->assertInstanceOf(OptionField::class, $field);
		$this->assertNull($field->icon);
		$this->assertNull($field->placeholder);
	}
}
