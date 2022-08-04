<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\Image
 */
class ImageTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$image = new Image();

		$this->assertNull($image->back);
		$this->assertNull($image->color);
		$this->assertNull($image->cover);
		$this->assertNull($image->disabled);
		$this->assertNull($image->icon);
		$this->assertNull($image->query);
		$this->assertNull($image->ratio);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactoryWithBool()
	{
		$image = Image::factory(false);
		$this->assertTrue($image->disabled);

		$image = Image::factory(true);
		$this->assertNull($image->disabled);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactoryWithString()
	{
		$image = Image::factory('page.cover');
		$this->assertSame('page.cover', $image->query);
	}
}
