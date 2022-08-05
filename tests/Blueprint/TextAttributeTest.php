<?php

namespace Kirby\Attribute;

use Kirby\Blueprint\TestCase;

/**
 * @covers \Kirby\Attribute\TextAttribute
 */
class TextAttributeTest extends TestCase
{
	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$text = TextAttribute::factory('Test');
		$this->assertSame('Test', $text->render($this->model()));
	}

	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$text = new TextAttribute(['en' => 'Test']);
		$this->assertSame('Test', $text->render($this->model()));
	}
}
