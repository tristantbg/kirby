<?php

namespace Kirby\Section;

/**
 * @covers \Kirby\Section\FieldsSection
 */
class FieldsSectionTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$section = new FieldsSection(
			id: 'test',
		);

		$this->assertNull($section->fields);
	}
}
