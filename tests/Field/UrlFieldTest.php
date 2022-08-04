<?php

namespace Kirby\Field;

use Kirby\Value\UrlValue;

/**
 * @covers \Kirby\Field\UrlField
 */
class UrlFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new UrlField('test');

		$this->assertInstanceOf(TextField::class, $field);
		$this->assertNull($field->autocomplete);
		$this->assertNull($field->icon);
		$this->assertNull($field->placeholder);
		$this->assertInstanceOf(UrlValue::class, $field->value);
	}

	/**
	 * @covers ::defaults
	 */
	public function testDefaults()
	{
		$field = new UrlField('test');
		$field->defaults();

		$this->assertSame('url', $field->autocomplete);
		$this->assertSame('url', $field->icon->value);
		$this->assertSame('https://example.com', $field->placeholder->translations['*']);
	}
}
