<?php

namespace Kirby\Enumeration;

use Kirby\Blueprint\EnumerationTestCase;

/**
 * @covers \Kirby\Section\SectionTextTheme
 */
class SectionTextThemeTest extends EnumerationTestCase
{
	public const CLASSNAME = SectionTextTheme::class;

	protected $allowed = [
		null,
		'negative',
		'notice',
		'positive'
	];

	protected $default = null;
}
