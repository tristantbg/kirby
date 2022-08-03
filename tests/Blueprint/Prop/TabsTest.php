<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Blueprint\TestCase;

/**
 * @covers \Kirby\Blueprint\Tabs
 */
class TabsTest extends TestCase
{
	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$tabs = Tabs::factory([
			'a' => [],
			'b' => []
		]);

		$this->assertCount(2, $tabs);
		$this->assertInstanceOf(Tab::class, $tabs->a);
		$this->assertInstanceOf(Tab::class, $tabs->b);
	}

	/**
	 * @covers ::render
	 */
	public function testRender()
	{
		$tabs = Tabs::factory([
			'a' => [
				'label' => 'Tab A',
				'icon'  => 'edit'
			],
		]);

		$expected = [
			[
				'icon'  => 'edit',
				'id'    => 'a',
				'label' => 'Tab A',
				'link'  => '/pages/test?tab=a'
			]
		];

		$this->assertSame($expected, $tabs->render($this->model()));
	}
}
