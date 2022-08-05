<?php

namespace Kirby\Enumeration;

/**
 * @covers \Kirby\Enumeration\FieldWidth
 */
class FieldWidthTest extends EnumerationTestCase
{
	public const CLASSNAME = FieldWidth::class;

	protected $allowed = [
		'1/1',
		'1/2',
		'1/3',
		'1/6',
		'1/4',
		'2/3',
		'2/6',
		'3/4',
		'3/6',
		'4/6',
		'5/6',
	];

	protected $default = '1/1';
}
