<?php

namespace Kirby\Enumeration;

use Kirby\Blueprint\EnumerationTestCase;

/**
 * @covers \Kirby\Enumeration\TextAlign
 */
class TextAlignTest extends EnumerationTestCase
{
	public const CLASSNAME = TextAlign::class;

	protected $allowed = [
		'left',
		'center',
		'right',
	];

	protected $default = 'left';
}
