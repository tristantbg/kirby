<?php

namespace Kirby\Blueprint;

use Kirby\Value\StringValue;

/**
 * Textarea field
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextareaField extends InputField
{
	public const TYPE = 'textarea';
	public StringValue $value;

	public function __construct(
		string $id,
		public Toolbar|null $buttons = null,
		public bool $counter = true,
		public string|null $default = null,
		public FilePickerOptions|null $files = null,
		public Font|null $font = null,
		public Icon|null $icon = null,
		public int|null $maxlength = null,
		public int|null $minlength = null,
		public Placeholder|null $placeholder = null,
		public FontSize|null $size = null,
		public bool $spellcheck = true,
		public UploadOptions|null $uploads = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new StringValue(
			maxlength: $this->maxlength,
			minlength: $this->minlength,
			required:  $this->required,
		);
	}
}
