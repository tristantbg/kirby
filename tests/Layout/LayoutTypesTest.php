<?php

namespace Kirby\Layout;

use Kirby\Cms\Page;

/**
 * @covers \Kirby\Layout\LayoutTypes
 */
class LayoutTypesTest extends TestCase
{
	/**
	 * @covers ::default
	 */
	public function testDefault()
	{
		$types = LayoutTypes::default();

		$this->assertCount(1, $types);
		$this->assertCount(1, $types->{0}->columns);
		$this->assertSame('1/1', $types->{0}->columns->{0}->value);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$types = LayoutTypes::factory([
			['1/2', '1/2'],
			['1/2', '1/4', '1/4']
		]);

		$this->assertCount(2, $types);
		$this->assertSame('1/2', $types->{0}->columns->{0}->value);
		$this->assertSame('1/4', $types->{1}->columns->{1}->value);
	}

	/**
	 * @covers ::render
	 */
	public function testRender()
	{
		$types = LayoutTypes::factory([
			['1/2', '1/2'],
			['1/2', '1/4', '1/4']
		]);

		$expected = [
			[
				'columns' => ['1/2', '1/2'],
				'id'      => '0',
			],
			[
				'columns' => ['1/2', '1/4', '1/4'],
				'id'      => '1',
			]
		];

		$page = new Page(['slug' => 'test']);
		$this->assertSame($expected, $types->render($page));
	}
}
