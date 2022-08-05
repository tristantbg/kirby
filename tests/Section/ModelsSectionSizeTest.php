<?php

namespace Kirby\Section;

use Kirby\Blueprint\EnumerationTestCase;

/**
 * @covers \Kirby\Section\ModelsSectionSize
 */
class ModelsSectionSizeTest extends EnumerationTestCase
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
