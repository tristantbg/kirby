<?php

namespace Kirby\Table;

/**
 * @covers \Kirby\Table\TableRows
 */
class TableRowsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$rows = new TableRows([
			$a = new TableRow(id: 'a', cells: new TableCells()),
			$b = new TableRow(id: 'b', cells: new TableCells())
		]);

		$this->assertCount(2, $rows);
		$this->assertSame($a, $rows->first());
		$this->assertSame($b, $rows->last());
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$rows = TableRows::factory([
			'a' => [
				'heading' => 'Heading A',
				'text'    => 'Text A'
			],
			'b' => [
				'heading' => 'Heading B',
				'text'    => 'Text B'
			]
		]);

		$this->assertCount(2, $rows);

		$rowA = $rows->first();
		$rowB = $rows->last();

		$this->assertSame('a', $rowA->id);
		$this->assertSame('Heading A', $rowA->cells->heading->value);
		$this->assertSame('Text A', $rowA->cells->text->value);

		$this->assertSame('b', $rowB->id);
		$this->assertSame('Heading B', $rowB->cells->heading->value);
		$this->assertSame('Text B', $rowB->cells->text->value);
	}
}
