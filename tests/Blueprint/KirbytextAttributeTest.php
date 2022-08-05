<?php

namespace Kirby\Attribute;

use Kirby\Blueprint\TestCase;

/**
 * @covers \Kirby\Attribute\KirbytextAttribute
 */
class KirbytextAttributeTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$text = new KirbytextAttribute(['en' => 'Test']);
		$this->assertSame('<p>Test</p>', $text->render($this->model()));
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$text = KirbytextAttribute::factory('Test');
		$this->assertSame('<p>Test</p>', $text->render($this->model()));
	}
}
