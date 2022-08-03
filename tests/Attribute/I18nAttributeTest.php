<?php

namespace Kirby\Attribute;

use Kirby\Blueprint\TestCase;

/**
 * @covers \Kirby\Attribute\I18nAttribute
 */
class I18nAttributeTest extends TestCase
{

	/**
	 * @covers ::__construct
	 */
	public function testConstructWithArray()
	{
		$translated = new I18nAttribute(['en' => 'Test']);
		$this->assertSame('Test', $translated->render($this->model()));
	}

	/**
	 * @covers ::__construct
	 */
	public function testConstructWithGlobal()
	{
		$translated = new I18nAttribute(['*' => 'avatar']);
		$this->assertSame('Profile picture', $translated->render($this->model()));
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$translated = I18nAttribute::factory('Test');
		$this->assertSame(['*' => 'Test'], $translated->translations);
	}
}
