<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\NodeKirbytext
 */
class NodeKirbytextTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$text = new NodeKirbytext(['en' => 'Test']);
		$this->assertSame('<p>Test</p>', $text->render($this->model()));
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$text = NodeKirbytext::factory('Test');
		$this->assertSame('<p>Test</p>', $text->render($this->model()));
	}
}
