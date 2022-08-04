<?php

namespace Kirby\Table;

use Kirby\Field\NumberField;
use Kirby\Cms\Page;

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

	/**
	 * @covers ::render
	 */
	public function testRender()
	{
		$cell = TableCell::factory([
			'id'    => 'test',
			'value' => 'test value'
		]);

		$page = new Page(['slug' => 'test']);

		$this->assertSame('test value', $cell->render($page));
	}

	/**
	 * @covers ::render
	 */
	public function testRenderWithColumn()
	{
		$column = new TableColumn(
			field: new NumberField(id: 'test'),
			id: 'test',
		);

		$cell = new TableCell(id: 'test', value: '5');
		$page = new Page(['slug' => 'test']);

		$this->assertSame('5', $cell->render($page));
		$this->assertSame(5, $cell->render($page, $column));
	}
}
