<?php

namespace Kirby\Table;

use Kirby\Blueprint\Prop\Label;
use Kirby\Field\TextField;
use Kirby\Field\ToggleField;

/**
 * @covers \Kirby\Table\TableColumn
 */
class TableColumnTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$column = new TableColumn(
			id: 'test'
		);

		$this->assertSame('test', $column->id);
		$this->assertInstanceOf(Label::class, $column->label);
		$this->assertSame('Test', $column->label->value);
		$this->assertFalse($column->mobile);
		$this->assertNull($column->align);
		$this->assertInstanceOf(TextField::class, $column->field);
		$this->assertNull($column->value);
		$this->assertNull($column->width);
	}

	public function testFactoryWithField()
	{
		$column = TableColumn::factory([
			'id'    => 'test',
			'field' => [
				'type'     => 'toggle',
				'required' => true
			]
		]);

		$this->assertInstanceOf(ToggleField::class, $column->field);
		$this->assertTrue($column->field->required);
	}

	public function testFactoryWithType()
	{
		$column = TableColumn::factory([
			'id'   => 'test',
			'type' => 'toggle'
		]);

		$this->assertInstanceOf(ToggleField::class, $column->field);
	}

}
