<?php

namespace Kirby\Section;

use Kirby\Blueprint\EnumerationTestCase;

/**
 * @covers \Kirby\Section\PagesSectionStatus
 */
class PagesSectionStatusTest extends EnumerationTestCase
{
	public const CLASSNAME = PagesSectionStatus::class;

	protected $allowed = [
		'all',
		'draft',
		'listed',
		'published',
		'unlisted',
		'unpublished'
	];

	protected $default = 'draft';

	public function provideHasAddButton(): array
	{
		return [
			['all', true],
			['draft', true],
			['listed', false],
			['published', false],
			['unlisted', false],
			['unpublished', false],
		];
	}

	public function provideIsSortable(): array
	{
		return [
			['all', true],
			['draft', false],
			['listed', true],
			['published', true],
			['unlisted', false],
			['unpublished', false],
		];
	}

	/**
	 * @dataProvider provideHasAddButton
	 * @covers ::hasAddButton
	 */
	public function testHasAddButton(string $input, bool $expected)
	{
		$status = new PagesSectionStatus($input);
		$this->assertSame($expected, $status->hasAddButton());
	}

	/**
	 * @dataProvider provideIsSortable
	 * @covers ::isSortable
	 */
	public function testIsSortable(string $input, bool $expected)
	{
		$status = new PagesSectionStatus($input);
		$this->assertSame($expected, $status->isSortable());
	}
}
