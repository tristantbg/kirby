<?php

namespace Kirby\Value;

class NumberValueTest extends TestCase
{
	public const CLASSNAME = NumberValue::class;

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
				'value'   => 3,
				'args'    => ['min' => 4],
				'message' => 'Please enter a value equal to or greater than 4'
			],
			[
				'value'   => 5,
				'args'    => ['max' => 4],
				'message' => 'Please enter a value equal to or lower than 4'
			]
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
				'value' => 1
			],
			[
				'value' => '1'
			],
			[
				'value' => 4,
				'args'  => ['min' => 4]
			],
			[
				'value' => 4,
				'args'  => ['max' => 4]
			]
		];
	}
}
