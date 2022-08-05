<?php

namespace Kirby\Field;

use Kirby\Layout\LayoutTypes;
use Kirby\Layout\LayoutSettings;

/**
 * Layout field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class LayoutField extends BlocksField
{
	public const TYPE = 'layout';

	public function __construct(
		public string $id,
		public LayoutTypes|null $layouts = null,
		public LayoutSettings|null $settings = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function layouts(): LayoutTypes
	{
		return $this->layouts ?? LayoutTypes::default();
	}
}
