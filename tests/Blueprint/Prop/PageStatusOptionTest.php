<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Attribute\LabelAttribute;
use Kirby\Attribute\TextAttribute;
use Kirby\Blueprint\TestCase;

/**
 * @covers \Kirby\Blueprint\PageStatusOption
 */
class PageStatusOptionTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$option = new PageStatusOption('draft');

		$this->assertFalse($option->disabled);
		$this->assertSame('draft', $option->id);
		$this->assertInstanceOf(LabelAttribute::class, $option->label);
		$this->assertInstanceOf(TextAttribute::class, $option->text);
	}

	/**
	 * @covers ::__construct
	 */
	public function testConstructWithInvalidId()
	{
		$this->expectException('Kirby\Exception\InvalidArgumentException');
		$this->expectExceptionMessage('The status must be draft, unlisted or listed');

		new PageStatusOption('drafts');
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$option = PageStatusOption::factory([
			'id'    => 'draft',
			'label' => $label = 'In draft mode',
			'text'  => $text = 'The page is still in draft mode'
		]);

		$this->assertFalse($option->disabled);
		$this->assertSame('draft', $option->id);
		$this->assertSame($label, $option->label->translations['*']);
		$this->assertSame($text, $option->text->translations['*']);
	}

	/**
	 * @covers ::prefab
	 */
	public function testPrefabWithFalse()
	{
		$option = PageStatusOption::prefab('draft', false);

		$this->assertTrue($option->disabled);
		$this->assertSame('draft', $option->id);
		$this->assertSame('page.status.draft', $option->label->translations['*']);
		$this->assertSame('page.status.draft.description', $option->text->translations['*']);
	}

	/**
	 * @covers ::prefab
	 */
	public function testPrefabWithNull()
	{
		$option = PageStatusOption::prefab('draft');

		$this->assertFalse($option->disabled);
		$this->assertSame('draft', $option->id);
		$this->assertSame('page.status.draft', $option->label->translations['*']);
		$this->assertSame('page.status.draft.description', $option->text->translations['*']);
	}

	/**
	 * @covers ::prefab
	 */
	public function testPrefabWithString()
	{
		$option = PageStatusOption::prefab('draft', 'In draft mode');

		$this->assertFalse($option->disabled);
		$this->assertSame('draft', $option->id);
		$this->assertSame('In draft mode', $option->label->translations['*']);
		$this->assertNull($option->text->translations['*']);
	}

	/**
	 * @covers ::prefab
	 */
	public function testPrefabWithTrue()
	{
		$option = PageStatusOption::prefab('draft', true);

		$this->assertFalse($option->disabled);
		$this->assertSame('draft', $option->id);
		$this->assertSame('page.status.draft', $option->label->translations['*']);
		$this->assertSame('page.status.draft.description', $option->text->translations['*']);
	}
}
