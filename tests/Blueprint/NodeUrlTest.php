<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\NodeUrl
 */
class NodeUrlTest extends TestCase
{
	public function testConstruct()
	{
		$url = new NodeUrl('/foo');
		$this->assertSame('/foo', $url->value);
	}

	public function testFactory()
	{
		$url = NodeUrl::factory('/foo');
		$this->assertSame('/foo', $url->value);
	}

	public function testRender()
	{
		$url = new NodeUrl('/foo');
		$this->assertSame('/foo', $url->render($this->model()));
	}
}
