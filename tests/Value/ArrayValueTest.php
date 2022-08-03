<?php

namespace Kirby\Value;

class ArrayValueTest extends TestCase
{
	public const CLASSNAME = ArrayValue::class;

	public function providerForInvalidValues(): array
	{
		return [
			[
				'value'   => [],
				'args'    => ['required' => true],
				'message' => 'Please enter something'
			],
			[
				'value'   => null,
				'args'    => ['required' => true],
				'message' => 'Please enter something'
			],
			[
				'value'   => ['a', 'b', 'c', 'd'],
				'args'    => ['max' => 3],
				'message' => 'Please enter a value equal to or lower than 3'
			],
			[
				'value'   => ['a', 'b', 'c'],
				'args'    => ['min' => 5],
				'message' => 'Please enter a value equal to or greater than 5'
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
				'value' => [],
			],
			[
				'value' => ['a', 'b', 'c']
			],
			[
				'value'   => ['a', 'b', 'c'],
				'args'    => ['max' => 4],
			],
			[
				'value'   => ['a', 'b', 'c'],
				'args'    => ['min' => 2],
			],
		];
	}
}
