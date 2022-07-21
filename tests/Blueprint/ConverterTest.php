<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\Converter
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
