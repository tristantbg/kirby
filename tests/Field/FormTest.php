<?php

namespace Kirby\Field;

/**
 * @covers \Kirby\Field\Form
 */
class FormTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$form = new Form(
			fields: new Fields([
				new TextField(id: 'heading', required: true),
				new InfoField(id: 'info'),
				new DateField(id: 'date'),
				new SelectField(id: 'category', options: new Prop\Options([
					new Prop\Option(value: 'a'),
					new Prop\Option(value: 'b'),
					new Prop\Option(value: 'c'),
				])),
				new TextareaField(id: 'text')
			])
		);

		$this->assertInstanceOf(Form::class, $form->submit([
			'heading'  => 'Test Heading',
			'date'     => '2012-12-12',
			'category' => 'a',
		]));

		$values = [
			'heading'  => 'Test Heading',
			'date'     => '2012-12-12 00:00:00',
			'category' => 'a',
			'text'     => null
		];

		$this->assertCount(5, $form->fields);
		$this->assertSame($values, $form->values()->toStrings());
	}
}
