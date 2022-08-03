<?php

namespace Kirby\Enumeration;

/**
 * @covers \Kirby\Enumeration\TimeNotation
 */
class TimeNotationTest extends EnumerationTestCase
{
	public const CLASSNAME = TimeNotation::class;

	protected $allowed = [
		12,
		24,
	];

	protected $default = 24;

	public function testDisplay()
	{
		$time = new TimeNotation;
		$this->assertSame('HH:mm', $time->display());

		$time = new TimeNotation(24);
		$this->assertSame('HH:mm', $time->display());

		$time = new TimeNotation(12);
		$this->assertSame('hh:mm a', $time->display());
	}

}
