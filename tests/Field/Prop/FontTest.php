<?php

namespace Kirby\Field\Prop;

use Kirby\Foundation\EnumerationTestCase;

/**
 * @covers \Kirby\Field\Font
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
