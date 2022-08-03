<?php

namespace Kirby\Attribute;

use Kirby\Blueprint\TestCase;

/**
 * @covers \Kirby\Attribute\UrlAttribute
 */
class UrlAttributeTest extends TestCase
{
	public function testConstruct()
	{
		$url = new UrlAttribute('/foo');
		$this->assertSame('/foo', $url->value);
	}

	public function testFactory()
	{
		$url = UrlAttribute::factory('/foo');
		$this->assertSame('/foo', $url->value);
	}

	public function testRender()
	{
		$url = new UrlAttribute('/foo');
		$this->assertSame('/foo', $url->render($this->model()));
	}
}
