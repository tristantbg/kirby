<?php

namespace Kirby\Attribute;

use Kirby\Cms\Page;
use Kirby\Cms\Site;
use Kirby\Section\TestCase;

/**
 * @covers \Kirby\Attribute\RelatedAttribute
 */
class RelatedAttributeTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$related = new RelatedAttribute('page.site');
		$this->assertSame('page.site', $related->value);
	}

	/**
	 * @covers ::model
	 */
	public function testModel()
	{
		$related = new RelatedAttribute('page.site');
		$model   = new Page(['slug' => 'test']);

		$this->assertInstanceOf(Site::class, $related->model($model));
	}
}
