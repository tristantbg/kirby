<?php

namespace Kirby\Field;

use Kirby\Blueprint\EnumerationTestCase;

/**
 * @covers \Kirby\Field\TextareaFieldFont
 */
class TextareaFieldFontTest extends EnumerationTestCase
{
	public const CLASSNAME = TextareaFieldFont::class;

	protected $allowed = [
		'monospace',
		'sans',
	];

	protected $default = 'sans';
}
