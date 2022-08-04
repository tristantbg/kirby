<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\BlueprintOption
 */
class BlueprintOptionTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		// nothing specified
		$option = new BlueprintOption();
		$this->assertSame(['*' => null], $option->permissions);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		// nothing specified
		$option = BlueprintOption::factory();
		$this->assertSame(['*' => null], $option->permissions);

		// true for all roles
		$option = BlueprintOption::factory(true);
		$this->assertSame(['*' => true], $option->permissions);

		// false for all roles
		$option = BlueprintOption::factory(false);
		$this->assertSame(['*' => false], $option->permissions);

		// specific rules
		$option = BlueprintOption::factory($input = ['*' => false, 'admin' => true]);
		$this->assertSame($input, $option->permissions);
	}
}
