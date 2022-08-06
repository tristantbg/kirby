<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\NodeString
 */
class NodeStringTest extends TestCase
{
	public function testConstruct()
	{
		$string = new NodeString('test');
		$this->assertSame('test', $string->value);
	}

	public function testFactory()
	{
		$string = NodeString::factory('test');
		$this->assertSame('test', $string->value);
	}

	public function testRender()
	{
		$string = new NodeString('test');
		$this->assertSame('test', $string->render($this->model()));
	}
}
