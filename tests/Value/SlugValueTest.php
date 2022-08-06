<?php

namespace Kirby\Value;

class SlugValueTest extends StringValueTest
{
	public const CLASSNAME = SlugValue::class;

	public function testSet()
	{
		$value = new SlugValue();

		$value->set('This is 12 äwesome');
		$this->assertSame('this-is-12-awesome', $value->data);
	}

	public function testSetWithSeparator()
	{
		$value = new SlugValue(separator: '_');

		$value->set('This is 123 äwesome');
		$this->assertSame('this_is_123_awesome', $value->data);
	}

	public function testSetWithAllowed()
	{
		$value = new SlugValue(allowed: 'a-z');

		$value->set('This is 123 äwesome');
		$this->assertSame('this-is-awesome', $value->data);
	}
}
