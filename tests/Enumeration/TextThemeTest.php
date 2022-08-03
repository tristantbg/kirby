<?php

namespace Kirby\Enumeration;

/**
 * @covers \Kirby\Enumeration\TextTheme
 */
class TextThemeTest extends EnumerationTestCase
{
	public const CLASSNAME = TextTheme::class;

	protected $allowed = [
		null,
		'negative',
		'notice',
		'positive'
	];

	protected $default = null;
}
