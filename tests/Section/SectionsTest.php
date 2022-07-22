<?php

namespace Kirby\Section;

/**
 * @covers \Kirby\Section\Sections
 */
class SectionsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$sections = new Sections([
			$a = new InfoSection('info'),
			$b = new FieldsSection('content'),
		]);

		$this->assertCount(2, $sections);
		$this->assertSame($a, $sections->info);
		$this->assertSame($b, $sections->content);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$sections = Sections::factory([
			'a' => [
				'type' => 'info'
			],
		]);

		$this->assertSame('a', $sections->first()->id);
	}
}
