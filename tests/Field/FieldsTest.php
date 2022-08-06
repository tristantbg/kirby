<?php

namespace Kirby\Field;

use Kirby\Value\NumberValue;
use Kirby\Value\StringValue;
use Kirby\Value\Values;

/**
 * @covers \Kirby\Field\Fields
 */
class FieldsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$fields = Fields::factory([
			'a' => [
				'type' => 'info'
			],
			'b' => [
				'type' => 'text'
			],
		]);

		$this->assertSame('a', $fields->first()->id);
		$this->assertInstanceOf(InfoField::class, $fields->first());
		$this->assertSame('b', $fields->last()->id);
		$this->assertInstanceOf(TextField::class, $fields->last());
	}

	/**
	 * @covers ::active
	 */
	public function testActive()
	{
		$fields = Fields::factory([
			'a' => [
				'type' => 'text'
			],
			'b' => [
				'type'     => 'text',
				'disabled' => true
			],
			'c' => [
				'type' => 'number',
				'when' => [
					'a' => 'A'
				]
			],
			'd' => [
				'type' => 'info'
			]
		]);

		$this->assertSame(['a'], $fields->active()->keys());

		// should enable the c field
		$fields->fill(['a' => 'A']);
		$this->assertSame(['a', 'c'], $fields->active()->keys());

		// should include the previously disabled field
		$fields->b->disabled = false;
		$this->assertSame(['a', 'b', 'c'], $fields->active()->keys());

		// should ignore all fields
		$fields->disable();
		$this->assertSame([], $fields->active()->keys());
	}

	/**
	 * @covers ::disable
	 */
	public function testDisable()
	{
		$fields = Fields::factory([
			'a' => [
				'type' => 'text'
			],
			'b' => [
				'type' => 'number'
			],
		]);

		$this->assertFalse($fields->a->disabled);
		$this->assertFalse($fields->b->disabled);

		$fields->disable();

		$this->assertTrue($fields->a->disabled);
		$this->assertTrue($fields->b->disabled);
	}

	/**
	 * @covers ::export
	 */
	public function testExport()
	{
		$fields = Fields::factory([
			'a' => [
				'type' => 'text'
			],
			'b' => [
				'type' => 'number'
			],
		]);

		$export = $fields->export();

		$this->assertCount(2, $export);
		$this->assertInstanceOf(Values::class, $export);
		$this->assertInstanceOf(StringValue::class, $export->a);
		$this->assertInstanceOf(NumberValue::class, $export->b);
	}

	/**
	 * @covers ::fill
	 */
	public function testFill()
	{
		$fields = Fields::factory([
			'a' => [
				'type' => 'text'
			],
			'b' => [
				'type' => 'number'
			],
			'c' => [
				'type' => 'info'
			]
		]);

		$expected = [
			'a' => null,
			'b' => null
		];

		$this->assertSame($expected, $fields->export()->toArray());

		$fields->fill($input = [
			'a' => 'Test',
			'b' => 12
		]);

		$this->assertSame($input, $fields->export()->toArray());
	}

	/**
	 * @covers ::fill
	 */
	public function testFillWithDefaults()
	{
		$fields = Fields::factory([
			'a' => [
				'type'    => 'text',
				'default' => 'A default'
			],
			'b' => [
				'type'    => 'number',
				'default' => 12
			],
			'c' => [
				'type' => 'text'
			]
		]);

		$fields->fill([]);

		$expected = [
			'a' => null,
			'b' => null,
			'c' => null
		];

		$this->assertSame($expected, $fields->export()->toArray());

		$fields->fill([], true);

		$expected = [
			'a' => 'A default',
			'b' => 12,
			'c' => null
		];

		$this->assertSame($expected, $fields->export()->toArray());
	}

	/**
	 * @covers ::inputs
	 */
	public function testInputs()
	{
		$fields = Fields::factory([
			'a' => [
				'type' => 'text'
			],
			'b' => [
				'type' => 'info'
			]
		]);

		$inputs = $fields->inputs();

		$this->assertCount(1, $inputs);
		$this->assertInstanceOf(TextField::class, $inputs->a);
	}

	/**
	 * @covers ::submit
	 */
	public function testSubmit()
	{
		$fields = Fields::factory([
			'a' => [
				'type' => 'text'
			],
			'b' => [
				'type' => 'number'
			],
			'c' => [
				'type' => 'info'
			]
		]);

		$expected = [
			'a' => null,
			'b' => null
		];

		$this->assertSame($expected, $fields->export()->toArray());

		$fields->submit($input = [
			'a' => 'Test',
			'b' => 12
		]);

		$this->assertSame($input, $fields->export()->toArray());
	}

	/**
	 * @covers ::unstranslated
	 */
	public function testUnstranslated()
	{
		$fields = Fields::factory([
			'a' => [
				'type' => 'text',
			],
			'b' => [
				'type'      => 'number',
				'translate' => false
			],
		]);

		$untranslated = $fields->untranslated();

		$this->assertCount(2, $fields);
		$this->assertCount(1, $untranslated);
		$this->assertInstanceOf(NumberField::class, $fields->b);
	}
}
