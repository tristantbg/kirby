<?php

namespace Kirby\Enumeration;

/**
 * @covers \Kirby\Enumeration\ItemSize
 */
class ItemSizeTest extends EnumerationTestCase
{
	public const CLASSNAME = ItemSize::class;

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
