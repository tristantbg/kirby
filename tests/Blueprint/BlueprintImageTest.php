<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\BlueprintImage
 */
class BlueprintImageTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$image = new BlueprintImage();

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
		$image = BlueprintImage::factory(false);
		$this->assertTrue($image->disabled);

		$image = BlueprintImage::factory(true);
		$this->assertNull($image->disabled);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactoryWithString()
	{
		$image = BlueprintImage::factory('page.cover');
		$this->assertSame('page.cover', $image->query);
	}
}
