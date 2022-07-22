<?php

namespace Kirby\Field;

use Kirby\Blueprint\Options;

/**
 * @covers \Kirby\Field\TagsField
 */
class TagsFieldTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$field = new TagsField('test');

		$this->assertInstanceOf(OptionsField::class, $field);
		$this->assertSame('test', $field->id);
		$this->assertSame(true, $field->any);
		$this->assertNull($field->icon);
		$this->assertFalse($field->list);
		$this->assertSame(',', $field->separator);
	}

	public function testValidateAny()
	{
		$field = new TagsField(
			id: 'test',
			options: Options::factory(['a', 'b']),
		);

		$field->value->set(['c']);
		$this->assertTrue($field->value->validate());
	}

	public function testValidateOptionsOnly()
	{
		$field = new TagsField(
			any: false,
			id: 'test',
			options: Options::factory(['a', 'b']),
		);

		$this->assertValidationError('Please select a valid option');

		$field->value->set(['c']);
		$field->value->validate();
	}
}
