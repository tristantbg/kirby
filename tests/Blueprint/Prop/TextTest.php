<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Blueprint\TestCase;

/**
 * @covers \Kirby\Blueprint\Text
 */
class TextTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$text = new Text();
		$this->assertNull($text->value);
	}

	/**
	 * @covers ::__construct
	 */
	public function testConstructWithString()
	{
		$text = new Text('Test');
		$this->assertSame('Test', $text->value);
	}

	/**
	 * @covers ::__construct
	 */
	public function testConstructWithArray()
	{
		$text = new Text(['en' => 'Test']);
		$this->assertSame('Test', $text->value);
	}
}
