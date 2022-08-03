<?php

namespace Kirby\Section;

/**
 * @covers \Kirby\Section\InfoSection
 */
class InfoSectionTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$section = new InfoSection(
			id: 'test',
		);

		$this->assertNull($section->label);
		$this->assertNull($section->help);
		$this->assertNull($section->text);
		$this->assertNull($section->theme);
	}
}
