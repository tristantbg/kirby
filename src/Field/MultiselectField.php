<?php

namespace Kirby\Field;

use Kirby\Attribute\IconAttribute;
use Kirby\Cms\ModelWithContent;

/**
 * Multiselect field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class MultiselectField extends OptionsField
{
	public const TYPE = 'multiselect';

	public function __construct(
		public string $id,
		public IconAttribute|null $icon = null,
		public bool $search = true,
		public bool $sort = true,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'icon'   => $this->icon?->render($model),
			'search' => $this->search,
			'sort'   => $this->sort
		];
	}
}
