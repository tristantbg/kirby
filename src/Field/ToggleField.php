<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Blueprint\Prop\Icon;
use Kirby\Field\Prop\After;
use Kirby\Field\Prop\Before;
use Kirby\Field\Prop\ToggleText;
use Kirby\Value\BoolValue;

/**
 * Toggle field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ToggleField extends InputField
{
	public const TYPE = 'toggle';
	public BoolValue $value;

	public function __construct(
		public string $id,
		public After|null $after = null,
		public Before|null $before = null,
		public bool|null $default = null,
		public Icon|null $icon = null,
		public ToggleText|null $text = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new BoolValue;
	}

	public function defaults(): void
	{
		$this->text ??= ToggleText::factory();
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'after'  => $this->after?->render($model),
			'before' => $this->before?->render($model),
			'icon'   => $this->icon?->render($model),
			'text'   => $this->text?->render($model),
		];
	}

}
