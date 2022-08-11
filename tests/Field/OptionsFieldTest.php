<?php

namespace Kirby\Field;

use Kirby\Option\Options;
use Kirby\Value\OptionsValue;

/**
 * @covers \Kirby\Field\OptionsField
 */
class OptionsFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new OptionsField('test');

		$this->assertNull($field->default);
		$this->assertNull($field->max);
		$this->assertNull($field->min);
		$this->assertSame(',', $field->separator);
		$this->assertNull($field->options);
		$this->assertInstanceOf(FieldOptions::class, $field->options());
		$this->assertInstanceOf(OptionsValue::class, $field->value);
	}
}
