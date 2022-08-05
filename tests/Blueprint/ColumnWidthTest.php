<?php

namespace Kirby\Enumeration;

/**
 * @covers \Kirby\Enumeration\ColumnWidth
 */
class ColumnWidthTest extends EnumerationTestCase
{
	public const CLASSNAME = ColumnWidth::class;

	protected $allowed = [
		'1/1',
		'1/2',
		'1/3',
		'1/4',
		'2/3',
		'3/4'
	];

	protected $default = '1/1';
}
