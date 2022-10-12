<?php

namespace Kirby\Form;

use Kirby\Cms\App;
use Kirby\Cms\File;
use Kirby\Cms\Page;
use PHPUnit\Framework\TestCase;

class FormTest extends TestCase
{
	public function testDataWithoutFields()
	{
		$form = new Form([
			'model' => new Page(['slug' => 'test']),
			'fields' => [],
			'values' => $values = [
				'a' => 'A',
				'b' => 'B'
			]
		]);

		$this->assertEquals($values, $form->data());
	}

	public function testValuesWithoutFields()
	{
		$form = new Form([
			'model' => new Page(['slug' => 'test']),
			'fields' => [],
			'values' => $values = [
				'a' => 'A',
				'b' => 'B'
			]
		]);

		$this->assertEquals($values, $form->values());
	}

	public function testDataFromUnsaveableFields()
	{
		new App([
			'roots' => [
				'index' => '/dev/null'
			]
		]);

		$page = new Page(['slug' => 'test']);
		$form = new Form([
			'model' => $page,
			'fields' => [
				'info' => [
					'type' => 'info',
				]
			],
			'values' => [
				'info' => 'Yay'
			]
		]);

		$this->assertNull($form->data()['info']);
	}

	public function testDataFromNestedFields()
	{
		new App([
			'roots' => [
				'index' => '/dev/null'
			]
		]);

		$page = new Page(['slug' => 'test']);
		$form = new Form([
			'model' => $page,
			'fields' => [
				'structure' => [
					'type' => 'structure',
					'fields' => [
						'tags' => [
							'type' => 'tags',
						]
					]
				]
			],
			'values' => $values = [
				'structure' => [
					[
						'tags' => 'a, b'
					]
				]
			]
		]);

		$this->assertEquals('a, b', $form->data()['structure'][0]['tags']);
	}

	public function testFieldOrder()
	{
		new App([
			'roots' => [
				'index' => '/dev/null'
			]
		]);

		$page = new Page(['slug' => 'test']);
		$form = new Form([
			'model' => $page,
			'fields' => [
				'a' => [
					'type' => 'text',
				],
				'b' => [
					'type' => 'text',
				]
			],
			'values' => [
				'c' => 'C',
				'b' => 'B',
				'a' => 'A',
			],
			'input' => [
				'b' => 'B modified'
			]
		]);

		$this->assertTrue(['a' => 'A', 'b' => 'B modified', 'c' => 'C'] === $form->values());
		$this->assertTrue(['a' => 'A', 'b' => 'B modified', 'c' => 'C'] === $form->data());
	}

	public function testStrictMode()
	{
		new App([
			'roots' => [
				'index' => '/dev/null'
			]
		]);

		$page = new Page(['slug' => 'test']);
		$form = new Form([
			'model' => $page,
			'fields' => [
				'a' => [
					'type' => 'text',
				],
				'b' => [
					'type' => 'text',
				]
			],
			'values' => [
				'b' => 'B',
				'a' => 'A'
			],
			'input' => [
				'c' => 'C'
			],
			'strict' => true
		]);

		$this->assertTrue(['a' => 'A', 'b' => 'B'] === $form->values());
		$this->assertTrue(['a' => 'A', 'b' => 'B'] === $form->data());
	}

	public function testErrors()
	{
		new App([
			'roots' => [
				'index' => '/dev/null'
			]
		]);

		$page = new Page(['slug' => 'test']);
		$form = new Form([
			'model' => $page,
			'fields' => [
				'a' => [
					'label' => 'Email',
					'type' => 'email',
				],
				'b' => [
					'label' => 'Url',
					'type' => 'url',
				]
			],
			'values' => [
				'a' => 'A',
				'b' => 'B',
			]
		]);


		$this->assertTrue($form->isInvalid());
		$this->assertFalse($form->isValid());

		$expected = [
			'a' => [
				'label' => 'Email',
				'message' => [
					'email' => 'Please enter a valid email address'
				]
			],
			'b' => [
				'label' => 'Url',
				'message' => [
					'url' => 'Please enter a valid URL'
				]
			]
		];

		$this->assertEquals($expected, $form->errors());

		// check for a correct cached array
		$this->assertEquals($expected, $form->errors());
	}

	public function testToArray()
	{
		new App([
			'roots' => [
				'index' => '/dev/null'
			]
		]);

		$page = new Page(['slug' => 'test']);
		$form = new Form([
			'model' => $page,
			'fields' => [
				'a' => [
					'label' => 'A',
					'type' => 'text',
				],
				'b' => [
					'label' => 'B',
					'type' => 'text',
				]
			],
			'values' => [
				'a' => 'A',
				'b' => 'B',
			]
		]);

		$this->assertEquals([], $form->toArray()['errors']);
		$this->assertArrayHasKey('a', $form->toArray()['fields']);
		$this->assertArrayHasKey('b', $form->toArray()['fields']);
		$this->assertCount(2, $form->toArray()['fields']);
		$this->assertEquals(false, $form->toArray()['invalid']);
	}

	public function testContent()
	{
		$form = new Form([
			'model'  => new Page(['slug' => 'test']),
			'fields' => [],
			'values' => $values = [
				'a' => 'A',
				'b' => 'B'
			]
		]);

		$this->assertEquals($values, $form->content());
	}

	public function testContentFromUnsaveableFields()
	{
		new App([
			'roots' => [
				'index' => '/dev/null'
			]
		]);

		$page = new Page(['slug' => 'test']);
		$form = new Form([
			'model'  => $page,
			'fields' => [
				'info' => [
					'type' => 'info',
				]
			],
			'values' => [
				'info' => 'Yay'
			]
		]);

		$this->assertCount(0, $form->content());
		$this->assertArrayNotHasKey('info', $form->content());
		$this->assertCount(1, $form->data());
		$this->assertArrayHasKey('info', $form->data());
	}

	public function testStrings()
	{
		$form = new Form([
			'model'  => new Page(['slug' => 'test']),
			'fields' => [],
			'values' => [
				'a' => 'A',
				'b' => 'B',
				'c' => [
					'd' => 'D',
					'e' => 'E'
				]
			]
		]);

		$this->assertSame([
			'a' => 'A',
			'b' => 'B',
			'c' => "d: D\ne: E\n"
		], $form->strings());
	}

	public function testPageForm()
	{
		$page = new Page([
			'slug' => 'test',
			'content' => [
				'title' => 'Test',
				'date'  => '2012-12-12'
			],
			'blueprint' => [
				'title' => 'Test',
				'name' => 'test',
				'fields' => [
					'date' => [
						'type' => 'date'
					]
				]
			]
		]);

		$form = Form::for($page, [
			'values' => [
				'title' => 'Updated Title',
				'date'  => null
			]
		]);

		$values = $form->values();

		// the title must always be transfered, even if not in the blueprint
		$this->assertEquals('Updated Title', $values['title']);

		// empty fields should be actually empty
		$this->assertSame('', $values['date']);
	}

	public function testPageFormWithClosures()
	{
		$page = new Page([
			'slug' => 'test',
			'content' => [
				'a' => 'A'
			]
		]);

		$form = Form::for($page, [
			'values' => [
				'a' => function ($value) {
					return $value . 'A';
				},
				'b' => function ($value) {
					return $value . 'B';
				},
			]
		]);

		$values = $form->values();

		$this->assertEquals('AA', $values['a']);
		$this->assertEquals('B', $values['b']);
	}

	public function testFileFormWithoutBlueprint()
	{
		new App([
			'roots' => [
				'index' => '/dev/null'
			]
		]);

		$page = new Page([
			'slug' => 'test'
		]);

		$file = new File([
			'filename' => 'test.jpg',
			'parent'   => $page,
			'content'  => []
		]);

		$form = Form::for($file, [
			'values' => ['a' => 'A', 'b' => 'B']
		]);

		$this->assertEquals(['a' => 'A', 'b' => 'B'], $form->data());
	}

	public function testUntranslatedFields()
	{
		$app = new App([
			'roots' => [
				'index' => '/dev/null'
			],
			'options' => [
				'languages' => true
			],
			'languages' => [
				[
					'code'    => 'en',
					'default' => true
				],
				[
					'code' => 'de'
				]
			]
		]);

		$page = new Page([
			'slug' => 'test',
			'blueprint' => [
				'fields' => [
					'a' => [
						'type' => 'text'
					],
					'b' => [
						'type' => 'text',
						'translate' => false
					]
				],
			]
		]);

		// default language
		$form = Form::for($page, [
			'input' => [
				'a' => 'A',
				'b' => 'B'
			]
		]);

		$expected = [
			'a' => 'A',
			'b' => 'B'
		];

		$this->assertEquals($expected, $form->values());

		// secondary language
		$form = Form::for($page, [
			'language' => 'de',
			'input' => [
				'a' => 'A',
				'b' => 'B'
			]
		]);

		$expected = [
			'a' => 'A',
			'b' => ''
		];

		$this->assertEquals($expected, $form->values());
	}
}
