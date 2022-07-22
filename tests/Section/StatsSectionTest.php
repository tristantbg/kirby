<?php

namespace Kirby\Section;

/**
 * @covers \Kirby\Section\StatsSection
 */
class StatsSectionTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$section = new StatsSection(
			id: 'test',
		);

		$this->assertNull($section->reports);
		$this->assertNull($section->size);
	}
}
