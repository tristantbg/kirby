<?php

namespace Kirby\Field;

use Kirby\Attribute\IconAttribute;
use Kirby\Attribute\LabelAttribute;
use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Polyfill;
use Kirby\Value\SlugValue;

/**
 * Slug field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class SlugField extends TextField
{
	public const TYPE = 'slug';

	public function __construct(
		public string $id,
		public string|null $allowed = null,
		public string|null $path = null,
		public string|null $sync = null,
		public SlugFieldWizard|null $wizard = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new SlugValue(
			allowed: $this->allowed,
			maxlength: $this->maxlength,
			minlength: $this->minlength,
			pattern: $this->pattern,
			required: $this->required,
		);
	}

	public function defaults(): void
	{
		$this->icon  ??= new IconAttribute('url');
		$this->label ??= new LabelAttribute(['*' => 'slug']);
	}

	public static function polyfill(array $props): array
	{
		// polyfill old allow option for more consistency
		$props = Polyfill::replace($props, 'allow', 'allowed');

		return parent::polyfill($props);
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'path'   => $this->path,
			'sync'   => $this->sync,
			'wizard' => $this->wizard?->render($model),
		];
	}

}
