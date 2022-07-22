<?php

namespace Kirby\Field;

/**
 * @covers \Kirby\Field\RangeField
 */
class RangeFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new RangeField('test');

		$this->assertInstanceOf(NumberField::class, $field);
		$this->assertTrue($field->tooltip);
	}
}
