<?php

namespace Kirby\Field;

use Kirby\Attribute\AfterAttribute;
use Kirby\Attribute\BeforeAttribute;
use Kirby\Attribute\PlaceholderAttribute;
use Kirby\Attribute\IconAttribute;
use Kirby\Cms\ModelWithContent;
use Kirby\Enumeration\Converter;
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
		public AfterAttribute|null $after = null,
		public string|null $autocomplete = null,
		public BeforeAttribute|null $before = null,
		public Converter|null $converter = null,
		public bool|null $counter = null,
		public string|null $default = null,
		public IconAttribute|null $icon = null,
		public int|null $maxlength = null,
		public int|null $minlength = null,
		public string|null $pattern = null,
		public PlaceholderAttribute|null $placeholder = null,
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
