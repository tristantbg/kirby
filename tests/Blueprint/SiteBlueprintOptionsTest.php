<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\SiteBlueprintOptions
 */
class SiteBlueprintOptionsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$options = new SiteBlueprintOptions();

		$this->assertNull($options->changeTitle);
		$this->assertNull($options->update);
	}
}
