<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\NodeI18n
 */
class NodeI18nTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstructWithArray()
	{
		$translated = new NodeI18n(['en' => 'Test']);
		$this->assertSame('Test', $translated->render($this->model()));
	}

	/**
	 * @covers ::__construct
	 */
	public function testConstructWithGlobal()
	{
		$translated = new NodeI18n(['*' => 'avatar']);
		$this->assertSame('Profile picture', $translated->render($this->model()));
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$translated = NodeI18n::factory('Test');
		$this->assertSame(['*' => 'Test'], $translated->translations);
	}
}
