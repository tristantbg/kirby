<?php

namespace Kirby\Attribute;

use Kirby\Blueprint\TestCase;

/**
 * @covers \Kirby\Attribute\LabelAttribute
 */
class LabelAttributeTest extends TestCase
{
	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$label = LabelAttribute::factory('My Label');

		$this->assertSame('My Label', $label->render($this->model()));
	}
}
