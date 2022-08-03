<?php

namespace Kirby\Block;

/**
 * @covers \Kirby\Block\BlockTypeGroups
 */
class BlockTypeGroupsTest extends TestCase
{
	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$groups = BlockTypeGroups::factory([
			'media' => [
				'types' => [
					'image',
					'video'
				]
			],
			'text' => [
				'types' => [
					'heading',
					'text'
				]
			]
		]);

		$this->assertCount(2, $groups);
		$this->assertInstanceOf(BlockType::class, $groups->media->types->image);
		$this->assertInstanceOf(BlockType::class, $groups->media->types->video);
		$this->assertInstanceOf(BlockType::class, $groups->text->types->heading);
		$this->assertInstanceOf(BlockType::class, $groups->text->types->text);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactoryWithoutGroups()
	{
		$groups = BlockTypeGroups::factory([
			'heading',
			'text',
			'image',
			'video'
		]);

		$this->assertCount(1, $groups);
		$this->assertInstanceOf(BlockType::class, $groups->blocks->types->heading);
		$this->assertInstanceOf(BlockType::class, $groups->blocks->types->text);
		$this->assertInstanceOf(BlockType::class, $groups->blocks->types->image);
		$this->assertInstanceOf(BlockType::class, $groups->blocks->types->video);
	}



}
