<?php

namespace Kirby\Field;

/**
 * @covers \Kirby\Field\GapField
 */
class GapFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new GapField(
			id: 'test',
		);

		$this->assertSame('test', $field->id);
	}
}
