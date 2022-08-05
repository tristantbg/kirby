<?php

namespace Kirby\Section;

use Kirby\Blueprint\EnumerationTestCase;

/**
 * @covers \Kirby\Section\InfoSectionTheme
 */
class InfoSectionThemeTest extends EnumerationTestCase
{
	public const CLASSNAME = InfoSectionTheme::class;

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
