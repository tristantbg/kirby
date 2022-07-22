<?php

namespace Kirby\Table;

/**
 * @covers \Kirby\Table\TableCell
 */
class TableCellTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$cell = new TableCell(id: 'test');

		$this->assertSame('test', $cell->id);
		$this->assertNull($cell->value);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$cell = TableCell::factory([
			'id'    => 'test',
			'value' => 'test value'
		]);

		$this->assertSame('test', $cell->id);
		$this->assertSame('test value', $cell->value);
	}
}
