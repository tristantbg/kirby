<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Blueprint\Prop\Icon;
use Kirby\Field\Prop\After;
use Kirby\Field\Prop\Before;
use Kirby\Field\Prop\Converter;
use Kirby\Field\Prop\Placeholder;
use Kirby\Value\StringValue;

/**
 * Text field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextField extends InputField
{
	public const TYPE = 'text';
	public StringValue $value;

	public function __construct(
		string $id,
		public After|null $after = null,
		public string|null $autocomplete = null,
		public Before|null $before = null,
		public Converter|null $converter = null,
		public bool|null $counter = null,
		public string|null $default = null,
		public Icon|null $icon = null,
		public int|null $maxlength = null,
		public int|null $minlength = null,
		public string|null $pattern = null,
		public Placeholder|null $placeholder = null,
		public bool|null $spellcheck = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new StringValue(
			maxlength: $this->maxlength,
			minlength: $this->minlength,
			pattern: $this->pattern,
			required: $this->required,
		);
	}

	public function defaults(): void
	{
		$this->counter    ??= true;
		$this->spellcheck ??= true;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'after'        => $this->after?->render($model),
			'autocomplete' => $this->autocomplete,
			'before'       => $this->before?->render($model),
			'counter'      => $this->counter,
			'icon'         => $this->icon?->render($model),
			'maxlength'    => $this->maxlength,
			'minlength'    => $this->minlength,
			'pattern'      => $this->pattern,
			'placeholder'  => $this->placeholder?->render($model),
			'spellcheck'   => $this->spellcheck,
		];
	}
}
