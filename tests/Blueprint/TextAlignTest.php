<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\TextAlign
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
