<?php

namespace Kirby\Field;

/**
 * Pages field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PagesField extends PickerField
{
	public const TYPE = 'pages';

	public function __construct(
		public string $id,
		...$args
	) {
		parent::__construct($id, ...$args);
	}
}
