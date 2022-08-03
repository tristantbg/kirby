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
				'blocks' => [
					'image',
					'video'
				]
			],
			'text' => [
				'blocks' => [
					'heading',
					'text'
				]
			]
		]);

		$this->assertCount(2, $groups);
		$this->assertInstanceOf(BlockType::class, $groups->media->blocks->image);
		$this->assertInstanceOf(BlockType::class, $groups->media->blocks->video);
		$this->assertInstanceOf(BlockType::class, $groups->text->blocks->heading);
		$this->assertInstanceOf(BlockType::class, $groups->text->blocks->text);
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
		$this->assertInstanceOf(BlockType::class, $groups->blocks->blocks->heading);
		$this->assertInstanceOf(BlockType::class, $groups->blocks->blocks->text);
		$this->assertInstanceOf(BlockType::class, $groups->blocks->blocks->image);
		$this->assertInstanceOf(BlockType::class, $groups->blocks->blocks->video);
	}



}
