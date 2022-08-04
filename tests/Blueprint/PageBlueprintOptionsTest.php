<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\PageBlueprintOptions
 */
class PageBlueprintOptionsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$options = new PageBlueprintOptions();

		$this->assertNull($options->changeSlug);
		$this->assertNull($options->changeStatus);
		$this->assertNull($options->changeTemplate);
		$this->assertNull($options->changeTitle);
		$this->assertNull($options->create);
		$this->assertNull($options->delete);
		$this->assertNull($options->duplicate);
		$this->assertNull($options->preview);
		$this->assertNull($options->read);
		$this->assertNull($options->update);
	}
}
