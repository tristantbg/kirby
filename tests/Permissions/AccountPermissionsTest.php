<?php

namespace Kirby\Permissions;

/**
 * @covers \Kirby\Permissions\AccountPermissions
 */
class AccountPermissionsTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$permissions = new AccountPermissions();
		$this->assertInstanceOf(UsersPermissions::class, $permissions);
	}
}
