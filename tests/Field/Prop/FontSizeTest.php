<?php

namespace Kirby\Field\Prop;

use Kirby\Foundation\EnumerationTestCase;

/**
 * @covers \Kirby\Field\FontSize
 */
class FontSizeTest extends EnumerationTestCase
{
	public const CLASSNAME = FontSize::class;

	protected $allowed = [
		'small',
		'medium',
		'large',
		'huge',
	];

	protected $default = 'medium';
}
