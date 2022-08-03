<?php

namespace Kirby\Enumeration;

/**
 * @covers \Kirby\Enumeration\Converter
 */
class ConverterTest extends EnumerationTestCase
{
	public const CLASSNAME = Converter::class;

	protected $allowed = [
		null,
		'lower',
		'slug',
		'ucfirst',
		'upper',
	];

	protected $default = null;
}
