<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\FileBlueprintAcceptRules
 */
class FileBlueprintAcceptRulesTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$accept = new FileBlueprintAcceptRules();

		$this->assertNull($accept->extensions);
		$this->assertNull($accept->mimeTypes);
		$this->assertNull($accept->maxheight);
		$this->assertNull($accept->maxsize);
		$this->assertNull($accept->maxwidth);
		$this->assertNull($accept->minheight);
		$this->assertNull($accept->minsize);
		$this->assertNull($accept->minwidth);
		$this->assertNull($accept->orientation);
		$this->assertNull($accept->types);
	}

	public function testExtension()
	{
		// string: single
		$accept = FileBlueprintAcceptRules::factory(['extension' => 'jpg']);
		$this->assertSame(['jpg'], $accept->extensions);

		// string: multiple
		$accept = FileBlueprintAcceptRules::factory(['extension' => 'jpg, gif']);
		$this->assertSame(['jpg', 'gif'], $accept->extensions);

		// array
		$accept = FileBlueprintAcceptRules::factory(['extension' => ['jpg', 'gif']]);
		$this->assertSame(['jpg', 'gif'], $accept->extensions);
	}

	public function testFactory()
	{
		$accept = FileBlueprintAcceptRules::factory('image/*');
		$this->assertSame(['image/*'], $accept->mimeTypes);
	}

	public function testMime()
	{
		// string: single
		$accept = FileBlueprintAcceptRules::factory(['mime' => 'image/*']);
		$this->assertSame(['image/*'], $accept->mimeTypes);

		// string: multiple
		$accept = FileBlueprintAcceptRules::factory(['mime' => 'image/*, application/*']);
		$this->assertSame(['image/*', 'application/*'], $accept->mimeTypes);

		// array
		$accept = FileBlueprintAcceptRules::factory(['mime' => ['image/*', 'application/*']]);
		$this->assertSame(['image/*', 'application/*'], $accept->mimeTypes);
	}

	public function testTypes()
	{
		// string: single
		$accept = FileBlueprintAcceptRules::factory(['type' => 'image']);
		$this->assertSame(['image'], $accept->types);

		// string: multiple
		$accept = FileBlueprintAcceptRules::factory(['type' => 'image, document']);
		$this->assertSame(['image', 'document'], $accept->types);

		// array
		$accept = FileBlueprintAcceptRules::factory(['type' => ['image', 'document']]);
		$this->assertSame(['image', 'document'], $accept->types);
	}
}
