<?php

namespace Kirby\Block;

use Kirby\Cms\Page;

/**
 * @covers \Kirby\Block\LayoutTypeColumns
 */
class LayoutTypeColumnsTest extends TestCase
{
	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$columns = LayoutTypeColumns::factory([
			'1/2',
			'1/4',
			'1/4'
		]);

		$this->assertSame('1/2', $columns->{0}->value);
		$this->assertSame('1/4', $columns->{1}->value);
		$this->assertSame('1/4', $columns->{2}->value);
	}

	/**
	 * @covers ::render
	 */
	public function testRender()
	{
		$columns = LayoutTypeColumns::factory([
			'1/2',
			'1/4',
			'1/4'
		]);

		$page = new Page(['slug' => 'test']);

		$this->assertSame(['1/2', '1/4', '1/4'], $columns->render($page));
	}
}
