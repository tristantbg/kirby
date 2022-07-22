<?php

namespace Kirby\Table;

/**
 * @covers \Kirby\Table\TableColumns
 */
class TableColumnsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$columns = TableColumns::factory([
			'a' => []
		]);

		$this->assertInstanceOf(TableColumn::class, $columns->first());
	}
}
