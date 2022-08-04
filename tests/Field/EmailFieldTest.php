<?php

namespace Kirby\Field;

use Kirby\Value\EmailValue;

/**
 * @covers \Kirby\Field\EmailField
 */
class EmailFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new EmailField(
			id: 'test',
		);

		$this->assertNull($field->autocomplete);
		$this->assertNull($field->icon);
		$this->assertNull($field->placeholder);
		$this->assertInstanceOf(EmailValue::class, $field->value);
	}

	/**
	 * @covers ::defaults
	 */
	public function testDefaults()
	{
		$field = new EmailField(
			id: 'test',
		);

		$field->defaults();

		$this->assertSame('email', $field->autocomplete);
		$this->assertSame('email', $field->icon->value);
		$this->assertSame('email.placeholder', $field->placeholder->translations['*']);
	}
}
