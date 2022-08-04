<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\PageBlueprintStatus
 */
class PageBlueprintStatusTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$status = new PageBlueprintStatus();

		$this->assertNull($status->draft);
		$this->assertNull($status->unlisted);
		$this->assertNull($status->listed);
	}
}
