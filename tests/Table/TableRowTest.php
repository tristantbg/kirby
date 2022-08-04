<?php

namespace Kirby\Table;

use Kirby\Cms\Page;

/**
 * @covers \Kirby\Table\TableRow
 */
class TableRowTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$row = new TableRow(
			id: 'test',
			cells: $cells = new TableCells()
		);

		$this->assertSame('test', $row->id);
		$this->assertSame($cells, $row->cells);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$row = TableRow::factory([
			'id' => 'test',
			'cells' => [
				'a' => 'foo'
			]
		]);

		$this->assertSame('test', $row->id);
		$this->assertSame('foo', $row->cells->a->value);
	}

	/**
	 * @covers ::render
	 */
	public function testRender()
	{
		$row = TableRow::factory([
			'id' => 'test',
			'cells' => [
				'a' => 'A',
				'b' => 'B'
			]
		]);

		$page = new Page(['slug' => 'test']);

		$expected = [
			'a' => 'A',
			'b' => 'B'
		];

		$this->assertSame($expected, $row->render($page));
	}
}
