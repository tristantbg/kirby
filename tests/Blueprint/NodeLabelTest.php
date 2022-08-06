<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\NodeLabel
 */
class NodeLabelTest extends TestCase
{
	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$label = NodeLabel::factory('My Label');
		$this->assertSame('My Label', $label->render($this->model()));
	}
}
