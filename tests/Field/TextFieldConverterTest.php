<?php

namespace Kirby\Field;

use Kirby\Blueprint\EnumerationTestCase;

/**
 * @covers \Kirby\Field\TextFieldConverter
 */
class TextFieldConverterTest extends EnumerationTestCase
{
	public const CLASSNAME = TextFieldConverter::class;

	protected $allowed = [
		null,
		'lower',
		'slug',
		'ucfirst',
		'upper',
	];

	protected $default = null;
}
