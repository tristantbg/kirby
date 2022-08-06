<?php

namespace Kirby\Block;

use Kirby\Cms\Page;

/**
 * @covers \Kirby\Block\LayoutType
 */
class LayoutTypeTest extends TestCase
{
	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$variant = LayoutType::factory([
			'id' => 'a',
			'columns' => [
				'1/2', '1/4', '1/4'
			]
		]);

		$this->assertSame('a', $variant->id);
		$this->assertSame('1/2', $variant->columns->{0}->value);
		$this->assertSame('1/4', $variant->columns->{1}->value);
		$this->assertSame('1/4', $variant->columns->{2}->value);
	}

	/**
	 * @covers ::render
	 */
	public function testRender()
	{
		$variant = LayoutType::factory([
			'id' => 'a',
			'columns' => [
				'1/2', '1/4', '1/4'
			]
		]);

		$expected = [
			'columns' => ['1/2', '1/4', '1/4'],
			'id'      => 'a'
		];

		$page = new Page(['slug' => 'test']);

		$this->assertSame($expected, $variant->render($page));
	}
}
