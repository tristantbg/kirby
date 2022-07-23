<?php

namespace Kirby\Field;

use Kirby\Blueprint\Prop\Icon;
use Kirby\Field\Prop\Placeholder;
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

		$this->autocomplete ??= 'url';
		$this->icon         ??= new Icon('url');
		$this->placeholder  ??= new Placeholder('https://example.com');

		$this->value = new UrlValue(
			maxlength: $this->maxlength,
			minlength: $this->minlength,
			pattern:   $this->pattern,
			required:  $this->required,
		);
	}
}
