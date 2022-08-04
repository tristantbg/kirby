<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\FileBlueprintOptions
 */
class FileBlueprintOptionsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$options = new FileBlueprintOptions();

		$this->assertNull($options->changeName);
		$this->assertNull($options->create);
		$this->assertNull($options->delete);
		$this->assertNull($options->read);
		$this->assertNull($options->replace);
		$this->assertNull($options->update);
	}
}
