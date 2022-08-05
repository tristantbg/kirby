<?php

namespace Kirby\Section;

use Kirby\Blueprint\Promise;
use Kirby\Section\TestCase;

/**
 * @covers \Kirby\Section\StatsSectionReports
 */
class StatsSectionReportsTest extends TestCase
{
	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$reports = StatsSectionReports::factory([
			'a' => [],
			'b' => []
		]);

		$this->assertCount(2, $reports);
		$this->assertSame('a', $reports->first()->id);
		$this->assertSame('b', $reports->last()->id);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactoryWithQuery()
	{
		$promise = Reports::factory('page.reports');

		$this->assertInstanceOf(Promise::class, $promise);
		$this->assertSame(StatsSectionReports::class, $promise->class);
		$this->assertSame('page.reports', $promise->query);
	}
}
