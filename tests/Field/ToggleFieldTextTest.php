<?php

namespace Kirby\Field;

/**
 * @covers \Kirby\Field\ToggleFieldText
 */
class ToggleFieldTextTest extends TestCase
{
	/**
	 * @covers ::factory
	 */
	public function testFactoryWithKeylessArray()
	{
		$text = ToggleFieldText::factory(['no', 'yes']);

		$this->assertSame('no', $text->off->translations['*']);
		$this->assertSame('yes', $text->on->translations['*']);

		$text = ToggleFieldText::factory(['no']);

		$this->assertSame('no', $text->off->translations['*']);
		$this->assertSame('no', $text->on->translations['*']);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactoryWithArray()
	{
		$text = ToggleFieldText::factory(['on' => 'yes', 'off' => 'no']);

		$this->assertSame('no', $text->off->translations['*']);
		$this->assertSame('yes', $text->on->translations['*']);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactoryWithString()
	{
		$text = ToggleFieldText::factory('toggle me');

		$this->assertSame('toggle me', $text->off->translations['*']);
		$this->assertSame('toggle me', $text->on->translations['*']);
	}
}
