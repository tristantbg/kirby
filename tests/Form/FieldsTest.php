<?php

namespace Kirby\Form;

use Kirby\Cms\App;
use Kirby\Cms\Page;
use PHPUnit\Framework\TestCase;

class FieldsTest extends TestCase
{
	public function setUp(): void
	{
		Field::$types = [];
	}

	public function tearDown(): void
	{
		Field::$types = [];
	}

	public function testConstruct()
	{
		Field::$types = [
			'test' => []
		];

		$page   = new Page(['slug' => 'test']);
		$fields = new Fields([
			'a' => [
				'type' => 'test',
				'model' => $page
			],
			'b' => [
				'type' => 'test',
				'model' => $page
			],
		]);

		$this->assertEquals('a', $fields->first()->name());
		$this->assertEquals('b', $fields->last()->name());
	}

	public function testFactoryWithInvalidFieldType()
	{
		new App([
			'roots' => [
				'index' => '/dev/null'
			]
		]);

		$page   = new Page(['slug' => 'test']);
		$fields = Fields::factory([
			'test' => [
				'model' => $page,
				'type'  => 'does-not-exist',
			]
		]);

		$field = $fields->first();

		$this->assertSame('info', $field->type());
		$this->assertSame('negative', $field->theme());
		$this->assertSame('Error in "test" field.', $field->label());
		$this->assertSame('<p>The field type "does-not-exist" does not exist</p>', $field->text());
	}

}
