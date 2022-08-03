<?php

namespace Kirby\Enumeration;

/**
 * @covers \Kirby\Enumeration\ItemLayout
 */
class ItemLayoutTest extends EnumerationTestCase
{
	public const CLASSNAME = ItemLayout::class;

	protected $allowed = [
		'cards',
		'cardlets',
		'list',
		'table',
	];

	protected $default = 'list';
}
