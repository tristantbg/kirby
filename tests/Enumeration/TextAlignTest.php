<?php

namespace Kirby\Enumeration;

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
