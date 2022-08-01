<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Blueprint\Prop\Icon;
use Kirby\Field\Prop\Placeholder;

/**
 * Select field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class SelectField extends OptionField
{
	public const TYPE = 'select';

	public function __construct(
		public string $id,
		public bool|null $empty = null,
		public Icon|null $icon = null,
		public Placeholder|null $placeholder = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->empty ??= false;

		parent::defaults();
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'empty'       => $this->empty,
			'icon'        => $this->icon?->render($model),
			'placeholder' => $this->placeholder?->render($model),
		];
	}

}
