<?php

namespace Kirby\Field;

/**
 * @covers \Kirby\Field\RadioField
 */
class RadioFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new RadioField('test');

		$this->assertInstanceOf(OptionField::class, $field);
		$this->assertSame(1, $field->columns);
	}
}
