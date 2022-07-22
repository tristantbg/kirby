<?php

namespace Kirby\Field;

/**
 * Checkboxes field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class CheckboxesField extends OptionsField
{
	public const TYPE = 'checkboxes';

	public function __construct(
		public string $id,
		public int $columns = 1,
		...$args
	) {
		parent::__construct($id, ...$args);
	}
}
