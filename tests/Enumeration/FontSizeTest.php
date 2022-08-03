<?php

namespace Kirby\Enumeration;

/**
 * @covers \Kirby\Enumeration\FontSize
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
