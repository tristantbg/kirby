<?php

namespace Kirby\Permissions;

/**
 * @covers \Kirby\Permissions\AccessPermissions
 */
class AccessPermissionsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$permissions = new AccessPermissions();

		$this->assertTrue($permissions->languages);
		$this->assertTrue($permissions->panel);
		$this->assertTrue($permissions->site);
		$this->assertTrue($permissions->system);
		$this->assertTrue($permissions->users);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$permissions = AccessPermissions::factory([
			'languages' => false
		]);

		$this->assertFalse($permissions->languages);
		$this->assertTrue($permissions->panel);
		$this->assertTrue($permissions->site);
		$this->assertTrue($permissions->system);
		$this->assertTrue($permissions->users);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactoryWithWildcard()
	{
		$permissions = AccessPermissions::factory(false);

		$this->assertFalse($permissions->languages);
		$this->assertFalse($permissions->panel);
		$this->assertFalse($permissions->site);
		$this->assertFalse($permissions->system);
		$this->assertFalse($permissions->users);
	}

}
