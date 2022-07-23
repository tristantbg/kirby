<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Blueprint\TestCase;

/**
 * @covers \Kirby\Blueprint\SiteOptions
 */
class SiteOptionsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$options = new SiteOptions();

		$this->assertNull($options->changeTitle);
		$this->assertNull($options->update);
	}
}
