<?php

namespace Kirby\Field;

use Kirby\Option\Options;
use Kirby\Value\OptionValue;

/**
 * @covers \Kirby\Field\OptionField
 */
class OptionFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new OptionField('test');

		$this->assertNull($field->default);
		$this->assertNull($field->options);
		$this->assertInstanceOf(OptionValue::class, $field->value);
	}
}
