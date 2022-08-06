<?php

namespace Kirby\Table;

/**
 * @covers \Kirby\Table\TableCells
 */
class TableCellsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$cells = new TableCells([
			$a = new TableCell('a'),
			$b = new TableCell('b')
		]);

		$this->assertCount(2, $cells);
		$this->assertSame($a, $cells->first());
		$this->assertSame($b, $cells->last());
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$cells = TableCells::factory([
			'cellA' => 'Cell A',
			'cellB' => 'Cell B'
		]);

		$this->assertSame('cellA', $cells->first()->id);
		$this->assertSame('Cell A', $cells->first()->value);
		$this->assertSame('cellB', $cells->last()->id);
		$this->assertSame('Cell B', $cells->last()->value);
	}
}
