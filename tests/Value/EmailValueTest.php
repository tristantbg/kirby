<?php

namespace Kirby\Value;

class EmailValueTest extends TestCase
{
	public const CLASSNAME = EmailValue::class;

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
				'args'    => [],
				'message' => 'Please enter a valid email address'
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
				'value' => 'test@getkirby.com'
			]
		];
	}
}
