<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Foundation\EnumerationTestCase;

/**
 * @covers \Kirby\Blueprint\Theme
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
