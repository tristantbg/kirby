<?php

namespace Kirby\Table;

use Kirby\Blueprint\EnumerationTestCase;

/**
 * @covers \Kirby\Table\TableColumnAlign
 */
class TableColumnAlignTest extends EnumerationTestCase
{
	public const CLASSNAME = TableColumnAlign::class;

	protected $allowed = [
		'left',
		'center',
		'right',
	];

	protected $default = 'left';
}
