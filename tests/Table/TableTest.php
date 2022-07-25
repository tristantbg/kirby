<?php

namespace Kirby\Table;

use Kirby\Cms\Page;

/**
 * @covers \Kirby\Table\Table
 */
class TableTest extends TestCase
{
	/**
	 * @covers ::render
	 */
	public function testRender()
	{
		$table = Table::factory([
			'columns' => [
				'a' => [],
				'b' => []
			],
			'rows' => [
				[
					'a' => 'Value A',
					'b' => 'Value B',
				]
			]
		]);

		$model  = new Page(['slug' => 'test']);
		$result = $table->render($model);

		$expected = [
			[
				'a' => 'Value A',
				'b' => 'Value B',
			]
		];

		$this->assertSame($expected, $result);
	}

	/**
	 * @covers ::render
	 */
	public function testRenderWithCustomValue()
	{
		$table = Table::factory([
			'columns' => [
				'a' => [
					'value' => 'Slug: {{ page.slug }}'
				],
				'b' => []
			],
			'rows' => [
				[
					'a' => 'Value A',
					'b' => 'Value B',
				]
			]
		]);

		$model  = new Page(['slug' => 'test']);
		$result = $table->render($model);

		$expected = [
			[
				'a' => 'Slug: test',
				'b' => 'Value B',
			]
		];

		$this->assertSame($expected, $result);
	}

	/**
	 * @covers ::render
	 */
	public function testRenderWithCustomField()
	{
		$table = Table::factory([
			'columns' => [
				'a' => [
					'type' => 'toggle'
				],
				'b' => [
					'type' => 'number'
				]
			],
			'rows' => [
				[
					'a' => 'on',
					'b' => '5',
				]
			]
		]);

		$model  = new Page(['slug' => 'test']);
		$result = $table->render($model);

		$expected = [
			[
				'a' => true,
				'b' => 5,
			]
		];

		$this->assertSame($expected, $result);
	}
}
