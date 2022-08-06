<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\NodeText
 */
class NodeTextTest extends TestCase
{
	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$text = NodeText::factory('Test');
		$this->assertSame('Test', $text->render($this->model()));
	}

	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$text = new NodeText(['en' => 'Test']);
		$this->assertSame('Test', $text->render($this->model()));
	}
}
