<?php

namespace Kirby\Section;

use Kirby\Blueprint\EnumerationTestCase;

/**
 * @covers \Kirby\Section\ModelsSectionLayout
 */
class ModelsSectionLayoutTest extends EnumerationTestCase
{
	public const CLASSNAME = ModelsSectionLayout::class;

	protected $allowed = [
		'cards',
		'cardlets',
		'list',
		'table',
	];

	protected $default = 'list';
}
