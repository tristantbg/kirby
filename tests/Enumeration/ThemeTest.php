<?php

namespace Kirby\Enumeration;

/**
 * @covers \Kirby\Enumeration\Theme
 */
class ThemeTest extends EnumerationTestCase
{
	public const CLASSNAME = Theme::class;

	protected $allowed = [
		'info',
		'negative',
		'none',
		'notice',
		'plain',
		'positive'
	];

	protected $default = 'plain';
}
