<?php

namespace Kirby\Value;

class UrlValueTest extends TestCase
{
	public const CLASSNAME = URLValue::class;

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
				'value'   => 'getkirby.com',
				'args'    => [],
				'message' => 'Please enter a valid URL'
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
				'value' => 'https://getkirby.com'
			]
		];
	}
}
