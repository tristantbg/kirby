<?php

namespace Kirby\Value;

use Kirby\Cms\App;

class TestCase extends \PHPUnit\Framework\TestCase
{
	protected $app;

	public function app(array $props = [])
	{
		return $this->app = new App(array_replace_recursive([
			'roots' => [
				'index' => '/dev/null'
			],
		], $props));
	}

	public function assertValidationError(string $message)
	{
		$this->expectException('Kirby\Exception\InvalidArgumentException');
		$this->expectExceptionMessage($message);
	}

	public function instance(...$args)
	{
		$classname = static::CLASSNAME;
		$instance  = new $classname(...$args);

		return $instance;
	}

	public function setUp(): void
	{
		$this->app();
	}

	/**
	 * @dataProvider providerForInvalidValues
	 */
	public function testInvalid($data, $args, $message)
	{
		$value = $this->instance(...$args);
		$value->set($data);

		$this->assertValidationError($message);
		$value->validate();
	}

	/**
	 * @dataProvider providerForValidValues
	 */
	public function testValid($data, $args = [])
	{
		$value = $this->instance(...$args);
		$value->set($data);

		$this->assertTrue($value->validate());
	}
}
