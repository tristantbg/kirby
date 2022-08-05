<?php

namespace Kirby\Section;

use Kirby\Section\TestCase;

/**
 * @covers \Kirby\Section\StatsSectionReport
 */
class StatsSectionReportTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$report = new StatsSectionReport('test');

		$this->assertNull($report->info);
		$this->assertNull($report->label);
		$this->assertNull($report->link);
		$this->assertNull($report->theme);
		$this->assertNull($report->value);
	}
}
