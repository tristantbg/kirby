<?php

namespace Kirby\Value;

class OptionsValueTest extends TestCase
{
	public const CLASSNAME = OptionsValue::class;

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
				'value'   => ['c'],
				'args'    => ['allowed' => ['a', 'b']],
				'message' => 'Please select a valid option'
			],
			[
				'value'   => ['a', 'c'],
				'args'    => ['allowed' => ['a', 'b']],
				'message' => 'Please select a valid option'
			],
			[
				'value'   => ['c'],
				'args'    => [
					'allowed' => fn () => ['a', 'b']
				],
				'message' => 'Please select a valid option'
			],
			[
				'value'   => ['a', 'b'],
				'args'    => ['allowed' => ['a', 'b'], 'max' => 1],
				'message' => 'Please enter a value equal to or lower than 1'
			],
			[
				'value'   => ['a'],
				'args'    => ['allowed' => ['a', 'b'], 'min' => 2],
				'message' => 'Please enter a value equal to or greater than 2'
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
				'value' => [],
			],
			[
				'value' => [1],
				'args'  => ['allowed' => [1, 2]],
			],
			[
				'value' => [2, 1],
				'args'  => ['allowed' => [1, 2]],
			],
			[
				'value' => [2, 1],
				'args'  => ['allowed' => fn () => [1, 2]],
			],
			[
				'value' => ['1'],
				'args'  => ['allowed' => ['1', '2']],
			],
		];
	}
}
