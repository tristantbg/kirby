<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\FontSize
 */
class FontSizeTest extends EnumerationTestCase
{
	public const CLASSNAME = FontSize::class;

	protected $allowed = [
		'small',
		'medium',
		'large',
		'huge',
	];

	protected $default = 'medium';
}
