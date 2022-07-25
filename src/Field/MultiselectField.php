<?php

namespace Kirby\Field;

use Kirby\Blueprint\Prop\Icon;

/**
 * Multiselect field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class MultiselectField extends OptionsField
{
	public const TYPE = 'multiselect';

	public function __construct(
		public string $id,
		public Icon|null $icon = null,
		public bool $search = true,
		public bool $sort = true,
		...$args
	) {
		parent::__construct($id, ...$args);
	}
}
