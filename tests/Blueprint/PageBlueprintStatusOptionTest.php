<?php

namespace Kirby\Blueprint;

/**
 * @covers \Kirby\Blueprint\PageBlueprintStatusOption
 */
class PageBlueprintStatusOptionTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$option = new PageBlueprintStatusOption('draft');

		$this->assertFalse($option->disabled);
		$this->assertSame('draft', $option->id);
		$this->assertNull($option->label);
		$this->assertNull($option->text);
	}

	/**
	 * @covers ::__construct
	 */
	public function testConstructWithInvalidId()
	{
		$this->expectException('Kirby\Exception\InvalidArgumentException');
		$this->expectExceptionMessage('The status must be draft, unlisted or listed');

		new PageBlueprintStatusOption('drafts');
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$option = PageBlueprintStatusOption::factory([
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
		$option = PageBlueprintStatusOption::prefab('draft', false);

		$this->assertTrue($option->disabled);
		$this->assertSame('draft', $option->id);
		$this->assertSame('page.status.draft', $option->label()->translations['*']);
		$this->assertSame('page.status.draft.description', $option->text()->translations['*']);
	}

	/**
	 * @covers ::prefab
	 */
	public function testPrefabWithNull()
	{
		$option = PageBlueprintStatusOption::prefab('draft');

		$this->assertFalse($option->disabled);
		$this->assertSame('draft', $option->id);
		$this->assertSame('page.status.draft', $option->label()->translations['*']);
		$this->assertSame('page.status.draft.description', $option->text()->translations['*']);
	}

	/**
	 * @covers ::prefab
	 */
	public function testPrefabWithString()
	{
		$option = PageBlueprintStatusOption::prefab('draft', 'In draft mode');

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
		$option = PageBlueprintStatusOption::prefab('draft', true);

		$this->assertFalse($option->disabled);
		$this->assertSame('draft', $option->id);
		$this->assertSame('page.status.draft', $option->label()->translations['*']);
		$this->assertSame('page.status.draft.description', $option->text()->translations['*']);
	}
}
