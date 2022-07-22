<?php

namespace Kirby\Field;

/**
 * @covers \Kirby\Field\LineField
 */
class LineFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new LineField(
			id: 'test',
		);

		$this->assertSame('test', $field->id);
	}
}
