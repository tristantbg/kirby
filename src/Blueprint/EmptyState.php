<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Empty state
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class EmptyState
{
	public function __construct(
		public NodeIcon|null $icon = null,
		public NodeText|null $text = null,
	) {
	}

	public function defaults(): static
	{
		$this->icon ??= new NodeIcon('page');
		$this->text ??= new NodeText(['*' => 'items.empty']);

		return $this;
	}

	public static function factory(string|array $props): static
	{
		if (is_string($props) === true) {
			$props = ['text' => $props];
		}

		$props = Factory::apply($props, [
			'icon' => NodeIcon::class,
			'text' => NodeText::class,
		]);

		return new static(...$props);
	}

	public static function field()
	{
		return NodeText::field()->set('id', 'empty')->set('label', 'Empty');
	}

	public function render(ModelWithContent $model): array
	{
		$this->defaults();

		return [
			'icon' => $this->icon?->render($model),
			'text' => $this->text?->render($model)
		];
	}
}
