<?php

namespace Kirby\Value;

class StringValueTest extends TestCase
{
	public const CLASSNAME = StringValue::class;

	public function providerForInvalidValues(): array
	{
		return [
			[
				'value'   => '',
				'args'    => ['required' => true],
				'message' => 'Please enter something'
			],
			[
				'value'   => null,
				'args'    => ['required' => true],
				'message' => 'Please enter something'
			],
			[
				'value'   => 'test',
				'args'    => ['maxlength' => 3],
				'message' => 'Please enter a shorter value. (max. 3 characters)'
			],
			[
				'value'   => 'test',
				'args'    => ['minlength' => 5],
				'message' => 'Please enter a longer value. (min. 5 characters)'
			],
			[
				'value'   => 'test',
				'args'    => ['pattern' => '!foo!'],
				'message' => 'The value does not match the expected pattern'
			],
		];
	}

	public function providerForValidValues(): array
	{
		return [
			[
				'value' => null,
			],
			[
				'value' => '',
			],
			[
				'value' => 'test'
			],
			[
				'value'   => 'test',
				'args'    => ['maxlength' => 4],
			],
			[
				'value'   => 'test',
				'args'    => ['minlength' => 4],
			],
			[
				'value'   => 'test',
				'args'    => ['pattern' => '!test!'],
			],
		];
	}
}
