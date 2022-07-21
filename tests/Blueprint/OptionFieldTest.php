<?php

namespace Kirby\Blueprint;

use Kirby\Value\OptionValue;

/**
 * @covers \Kirby\Blueprint\OptionField
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
		$this->assertInstanceOf(Options::class, $field->options());
		$this->assertInstanceOf(OptionValue::class, $field->value);
	}

}
