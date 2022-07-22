<?php

namespace Kirby\Field;

use Kirby\Blueprint\Label;

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

		$this->assertInstanceOf(Label::class, $field->label);
		$this->assertNull($field->help);
		$this->assertNull($field->text);
		$this->assertNull($field->theme);
	}
}
