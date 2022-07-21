<?php

namespace Kirby\Blueprint;

use Kirby\Value\EmailValue;

/**
 * @covers \Kirby\Blueprint\EmailField
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

		$this->assertSame('email', $field->autocomplete);
		$this->assertSame('email', $field->icon->value);
		$this->assertSame('mail@example.com', $field->placeholder->value);
		$this->assertInstanceOf(EmailValue::class, $field->value);
	}
}
