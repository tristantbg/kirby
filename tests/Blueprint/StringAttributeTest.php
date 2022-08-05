<?php

namespace Kirby\Attribute;

use Kirby\Blueprint\TestCase;

/**
 * @covers \Kirby\Attribute\StringAttribute
 */
class StringAttributeTest extends TestCase
{
	public function testConstruct()
	{
		$string = new StringAttribute('test');
		$this->assertSame('test', $string->value);
	}

	public function testFactory()
	{
		$string = StringAttribute::factory('test');
		$this->assertSame('test', $string->value);
	}

	public function testRender()
	{
		$string = new StringAttribute('test');
		$this->assertSame('test', $string->render($this->model()));
	}
}
