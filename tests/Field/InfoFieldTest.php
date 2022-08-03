<?php

namespace Kirby\Field;

/**
 * @covers \Kirby\Field\InfoField
 */
class InfoFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new InfoField(
			id: 'test',
		);

		$this->assertNull($field->label);
		$this->assertNull($field->help);
		$this->assertNull($field->text);
		$this->assertNull($field->theme);
	}
}
