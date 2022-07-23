<?php

namespace Kirby\Section\Prop;

use Kirby\Foundation\EnumerationTestCase;

/**
 * @covers \Kirby\Blueprint\Size
 */
class SizeTest extends EnumerationTestCase
{
	public const CLASSNAME = Size::class;

	protected $allowed = [
		'auto',
		'tiny',
		'small',
		'medium',
		'large',
		'huge'
	];

	protected $default = 'auto';
}
