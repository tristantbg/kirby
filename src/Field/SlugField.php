<?php

namespace Kirby\Field;

use Kirby\Blueprint\Prop\Icon;
use Kirby\Blueprint\Prop\Label;
use Kirby\Field\Prop\After;
use Kirby\Field\Prop\Before;
use Kirby\Field\Prop\Placeholder;
use Kirby\Field\Prop\SlugWizard;
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
class SlugField extends InputField
{
	public const TYPE = 'slug';

	public function __construct(
		public string $id,
		public After|null $after = null,
		public string|null $allowed = null,
		public Before|null $before = null,
		public string|null $default = null,
		public Icon|null $icon = null,
		public int|null $maxlength = null,
		public int|null $minlength = null,
		public string|null $path = null,
		public string|null $pattern = null,
		public Placeholder|null $placeholder = null,
		public string|null $sync = null,
		public SlugWizard|null $wizard = null,
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
		$this->icon  ??= new Icon('url');
		$this->label ??= new Label(['*' => 'slug']);
	}

	public static function polyfill(array $props): array
	{
		// polyfill old allow option for more consistency
		$props['allowed'] ??= $props['allow'] ?? null;
		unset($props['allow']);

		return parent::polyfill($props);
	}
}
