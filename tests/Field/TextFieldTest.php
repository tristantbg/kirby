<?php

namespace Kirby\Field;

use Kirby\Value\StringValue;

/**
 * @covers \Kirby\Field\TextField
 */
class TextFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new TextField(
			id: 'test',
		);

		$this->assertNull($field->after);
		$this->assertNull($field->autocomplete);
		$this->assertNull($field->before);
		$this->assertNull($field->converter);
		$this->assertTrue($field->counter);
		$this->assertNull($field->default);
		$this->assertNull($field->icon);
		$this->assertNull($field->maxlength);
		$this->assertNull($field->minlength);
		$this->assertNull($field->pattern);
		$this->assertNull($field->placeholder);
		$this->assertFalse($field->spellcheck);
		$this->assertInstanceOf(StringValue::class, $field->value);
	}

}
