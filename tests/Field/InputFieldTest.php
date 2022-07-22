<?php

namespace Kirby\Field;

use Kirby\Blueprint\Label;

/**
 * @covers \Kirby\Field\InputField
 */
class InputFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new InputField(
			id: 'test'
		);

		$this->assertSame('test', $field->id);
		$this->assertFalse($field->autofocus);
		$this->assertNull($field->help);
		$this->assertInstanceOf(Label::class, $field->label);
		$this->assertFalse($field->required);
		$this->assertTrue($field->translate);
		$this->assertNull($field->width);
		$this->assertNull($field->when);
	}
}
