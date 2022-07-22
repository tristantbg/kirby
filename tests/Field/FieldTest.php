<?php

namespace Kirby\Field;

/**
 * @covers \Kirby\Field\Field
 */
class FieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new Field(
			id: 'test',
		);

		$this->assertSame('test', $field->id);
	}
}
