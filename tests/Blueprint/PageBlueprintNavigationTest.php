<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\PageBlueprintNavigation
 */
class PageBlueprintNavigationTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$navigation = new PageBlueprintNavigation();

		$this->assertNull($navigation->sortBy);
		$this->assertNull($navigation->status);
		$this->assertNull($navigation->template);
	}

	/**
	 * @covers ::__construct
	 */
	public function testSortBy()
	{
		$navigation = new PageBlueprintNavigation(
			sortBy: 'title desc'
		);

		$this->assertSame('title desc', $navigation->sortBy);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactoryWithStatus()
	{
		// single
		$navigation = PageBlueprintNavigation::factory([
			'status' => 'listed'
		]);

		$this->assertSame(['listed'], $navigation->status);

		// wildcard
		$navigation = PageBlueprintNavigation::factory([
			'status' => 'all'
		]);

		$this->assertSame(['*'], $navigation->status);

		// array
		$navigation = PageBlueprintNavigation::factory([
			'status' => ['draft', 'listed']
		]);

		$this->assertSame(['draft', 'listed'], $navigation->status);
	}

	/**
	 * @covers ::__construct
	 */
	public function testTemplate()
	{
		// single
		$navigation = PageBlueprintNavigation::factory([
			'template' => 'article'
		]);

		$this->assertSame(['article'], $navigation->template);

		// wildcard
		$navigation = PageBlueprintNavigation::factory([
			'template' => 'all'
		]);

		$this->assertSame(['*'], $navigation->template);

		// array
		$navigation = PageBlueprintNavigation::factory([
			'template' => ['article', 'video']
		]);

		$this->assertSame(['article', 'video'], $navigation->template);
	}
}
