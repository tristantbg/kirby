<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Foundation\EnumerationTestCase;

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
