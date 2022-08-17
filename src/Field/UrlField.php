<?php

namespace Kirby\Field;

use Kirby\Value\UrlValue;

/**
 * Url field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class UrlField extends TextField
{
	public const TYPE = 'url';

	public function __construct(...$args)
	{
		parent::__construct(...$args);

		$this->value = new UrlValue(
			maxlength: $this->maxlength,
			minlength: $this->minlength,
			pattern:   $this->pattern,
			required:  $this->required,
		);
	}

	public function defaults(): static
	{
		$this->autocomplete ??= new FieldAutocomplete('url');
		$this->icon         ??= new FieldIcon('url');
		$this->placeholder  ??= new FieldPlaceholder(['*' => 'https://example.com']);

		return parent::defaults();
	}
}
