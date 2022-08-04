<?php

namespace Kirby\Field;

use Kirby\Attribute\IconAttribute;
use Kirby\Attribute\PlaceholderAttribute;
use Kirby\Cms\ModelWithContent;

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
		public IconAttribute|null $icon = null,
		public PlaceholderAttribute|null $placeholder = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function empty(): bool
	{
		return $this->empty ?? false;
	}

	public function icon(): ?IconAttribute
	{
		return $this->icon;
	}

	public function placeholder(): ?PlaceholderAttribute
	{
		return $this->placeholder;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'empty'       => $this->empty(),
			'icon'        => $this->icon()?->render($model),
			'placeholder' => $this->placeholder()?->render($model),
		];
	}

}
