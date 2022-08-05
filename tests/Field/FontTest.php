<?php

namespace Kirby\Enumeration;

/**
 * @covers \Kirby\Enumeration\Font
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
