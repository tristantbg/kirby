<?php

namespace Kirby\Blueprint;

use Kirby\Blueprint\Prop\UserImage;

/**
 * @covers \Kirby\Blueprint\UserBlueprint
 */
class UserBlueprintTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$blueprint = new UserBlueprint(
			id: 'test'
		);

		$this->assertNull($blueprint->image);
		$this->assertNull($blueprint->options);
		$this->assertNull($blueprint->permissions);
	}
}
