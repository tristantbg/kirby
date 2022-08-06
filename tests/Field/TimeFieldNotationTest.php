<?php

namespace Kirby\Field;

use Kirby\Blueprint\EnumerationTestCase;

/**
 * @covers \Kirby\Field\TimeFieldNotation
 */
class TimeFieldNotationTest extends EnumerationTestCase
{
	public const CLASSNAME = TimeFieldNotation::class;

	protected $allowed = [
		12,
		24,
	];

	protected $default = 24;

	public function testDisplay()
	{
		$time = new TimeFieldNotation();
		$this->assertSame('HH:mm', $time->display());

		$time = new TimeFieldNotation(24);
		$this->assertSame('HH:mm', $time->display());

		$time = new TimeFieldNotation(12);
		$this->assertSame('hh:mm a', $time->display());
	}
}
