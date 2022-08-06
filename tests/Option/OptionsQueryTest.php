<?php

namespace Kirby\Option;

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Field\TestCase;

class MyPage extends Page {
	public function myArray(): array
	{
		return [['name' => 'foo'], ['name' => 'bar']];
	}

	public function myOptions(): Options
	{
		return Options::factory(['foo', 'bar']);
	}
}

/**
 * @covers \Kirby\Option\OptionsQuery
 */
class OptionsQueryTest extends TestCase
{
	/**
	 * @covers ::__construct
	 */
	public function testConstruct()
	{
		$options = new OptionsQuery('site.children', '{{ page.slug }}');
		$this->assertSame('site.children', $options->query);
		$this->assertSame('{{ page.slug }}', $options->text);
		$this->assertNull($options->value);
	}

	/**
	 * @covers ::factory
	 */
	public function testFactory()
	{
		$options = OptionsQuery::factory([
			'query' => 'site.children',
			'text'  => '{{ page.slug }}'
		]);

		$this->assertSame('site.children', $options->query);
		$this->assertSame('{{ page.slug }}', $options->text);
		$this->assertNull($options->value);
	}

	// /**
	//  * @covers ::resolve
	//  */
	// public function testResolveForArray()
	// {
	// 	$model   = new MyPage(['slug' => 'a']);
	// 	$options = new OptionsQuery(
	// 		query: 'page.myArray',
	// 		value: '{{ arrayItem.name }}',
	// 	);
	// 	$options = $options->render($model);

	// 	$this->assertSame('foo', $options[0]['value']);
	// 	$this->assertSame('bar', $options[1]['value']);
	// }

	/**
	 * @covers ::resolve
	 */
	public function testResolveForPages()
	{
		$app = new App([
			'site' => [
				'children' => [
					['slug' => 'a'],
					['slug' => 'b'],
					['slug' => 'c'],
				]
			]
		]);

		$options = new OptionsQuery(
			query: 'site.children',
			text: '{{ page.slug }}'
		);
		$options = $options->render($app->site());


		$this->assertSame('a', $options[0]['text']);
		$this->assertSame('a', $options[0]['value']);
		$this->assertSame('b', $options[1]['text']);
		$this->assertSame('c', $options[2]['text']);
	}

	/**
	 * @covers ::resolve
	 */
	public function testResolveForOptions()
	{
		$model   = new MyPage(['slug' => 'a']);
		$options = new OptionsQuery('page.myOptions');
		$options = $options->render($model);

		$this->assertSame('foo', $options[0]['text']);
		$this->assertSame('foo', $options[0]['value']);
		$this->assertSame('bar', $options[1]['text']);
		$this->assertSame('bar', $options[1]['value']);
	}
}
