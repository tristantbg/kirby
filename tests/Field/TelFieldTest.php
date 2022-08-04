<?php

namespace Kirby\Field;

/**
 * @covers \Kirby\Field\TelField
 */
class TelFieldTest extends TestCase
{
	/**
	 * @covers ::defaults
	 */
	public function testDefaults()
	{
		$field = new TelField(
			id: 'test',
		);

		$field->defaults();

		$this->assertSame('tel', $field->autocomplete);
		$this->assertSame('phone', $field->icon->value);
	}
}
