<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Field\Fields;
use Kirby\Section\Sections;

/**
 * Tab
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Tab extends NodeLabelled
{
	public function __construct(
		public string $id,
		public NodeIcon|null $icon = null,
		public Columns|null $columns = null,
		...$args,
	) {
		parent::__construct($id, ...$args);
	}

	public function columns(): Columns
	{
		return $this->columns ?? new Columns();
	}

	/**
	 * Collects all fields from all columns
	 */
	public function fields(): Fields
	{
		return $this->sections()->fields();
	}

	public function render(ModelWithContent $model, bool $active = false): array
	{
		if ($active === true) {
			return [
				'columns' => $this->columns()->render($model),
				'id'      => $this->id,
			];
		}

		return [
			'icon'  => $this->icon?->render($model),
			'id'    => $this->id,
			'label' => $this->label()->render($model),
			'link'  => $model->panel()->url(true) . '?tab=' . $this->id,
		];
	}

	/**
	 * Tabs can use shortcuts for fields and sections
	 * without properly wrapping them in a fields section
	 * or columns. The polyfill will wrap them properly.
	 */
	public static function polyfill(array $props): array
	{
		$props = Polyfill::fields($props);
		$props = Polyfill::sections($props);

		return parent::polyfill($props);
	}

	/**
	 * Collects all sections from all columns
	 */
	public function sections(): Sections
	{
		return $this->columns()->sections();
	}
}
