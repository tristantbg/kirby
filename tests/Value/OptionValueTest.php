<?php

namespace Kirby\Value;

class OptionValueTest extends TestCase
{
	public const CLASSNAME = OptionValue::class;

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
				'value'   => 'c',
				'args'    => ['allowed' => ['a', 'b']],
				'message' => 'Please select a valid option'
			],
			[
				'value'   => 'c',
				'args'    => [
					'allowed' => fn() => ['a', 'b']
				],
				'message' => 'Please select a valid option'
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
				'value' => 1,
				'args'  => ['allowed' => [1]],
			],
			[
				'value' => '1',
				'args'  => ['allowed' => ['1']],
			],
		];
	}
}
