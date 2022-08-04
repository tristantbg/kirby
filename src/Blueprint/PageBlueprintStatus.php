<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Page Blueprint Status
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PageBlueprintStatus
{
	public function __construct(
		public PageBlueprintStatusOption|null $draft    = null,
		public PageBlueprintStatusOption|null $unlisted = null,
		public PageBlueprintStatusOption|null $listed   = null
	) {
	}

	public function draft(): PageBlueprintStatusOption
	{
		return $this->draft ?? new PageBlueprintStatusOption('draft');
	}

	public static function factory(array $props): static
	{
		foreach ($props as $id => $option) {
			$props[$id] = PageBlueprintStatusOption::prefab($id, $option);
		}

		return new static(...$props);
	}

	public function listed(): PageBlueprintStatusOption
	{
		return $this->listed ?? new PageBlueprintStatusOption('listed');
	}

	public function render(ModelWithContent $model): array|false
	{
		return array_filter([
			'draft'    => $this->draft()->render($model),
			'unlisted' => $this->unlisted()->render($model),
			'listed'   => $this->listed()->render($model),
		]);
	}

	public function unlisted(): PageBlueprintStatusOption
	{
		return $this->unlisted ?? new PageBlueprintStatusOption('unlisted');
	}
}
