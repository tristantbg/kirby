<?php

namespace Kirby\Field\Prop;

use Kirby\Foundation\EnumerationTestCase;

/**
 * @covers \Kirby\Field\Converter
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
