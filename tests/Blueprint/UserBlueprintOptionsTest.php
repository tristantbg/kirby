<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\UserBlueprintOptions
 */
class UserBlueprintOptionsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$options = new UserBlueprintOptions();

		$this->assertNull($options->changeEmail);
		$this->assertNull($options->changeLanguage);
		$this->assertNull($options->changeName);
		$this->assertNull($options->changePassword);
		$this->assertNull($options->changeRole);
		$this->assertNull($options->create);
		$this->assertNull($options->delete);
		$this->assertNull($options->update);
	}
}
