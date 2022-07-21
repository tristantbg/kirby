<?php

namespace Kirby\Blueprint;

/**
 * Headline field
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class HeadlineField extends Field
{
	public const TYPE = 'headline';

	public function __construct(
		public string $id,
		public Help|null $help = null,
		public Label|null $label = null,
		public bool $numbered = true,
		...$args
	) {
		parent::__construct($id, ...$args);
		$this->label ??= Label::fallback($id);
	}
}
