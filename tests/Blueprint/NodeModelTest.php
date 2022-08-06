<?php

namespace Kirby\Blueprint;

use Kirby\Cms\Page;
use Kirby\Cms\Site;
use Kirby\Section\TestCase;

/**
 * @covers \Kirby\Blueprint\NodeModel
 */
class NodeModelTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$related = new NodeModel('page.site');
		$this->assertSame('page.site', $related->value);
	}

	/**
	 * @covers ::model
	 */
	public function testModel()
	{
		$related = new NodeModel('page.site');
		$model   = new Page(['slug' => 'test']);

		$this->assertInstanceOf(Site::class, $related->model($model));
	}
}
