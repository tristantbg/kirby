<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\Font
 */
class FontTest extends EnumerationTestCase
{
	public const CLASSNAME = Font::class;

	protected $allowed = [
		'monospace',
		'sans',
	];

	protected $default = 'sans';
}
