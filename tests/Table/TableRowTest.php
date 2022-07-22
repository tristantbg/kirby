<?php

namespace Kirby\Table;

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
}
