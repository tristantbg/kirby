<?php

namespace Kirby\Field;

use Kirby\Architect\InspectorSection;
use Kirby\Blueprint\Bools;
use Kirby\Blueprint\NodeLabel;

/**
 * Nodes
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class WriterFieldNodes extends Bools
{
	public function __construct(
		public bool $bulletList = true,
		public bool $heading = true,
		public bool $paragraph = true,
		public bool $orderedList = true,
	) {
	}

	public static function inspectorSection(): InspectorSection
	{
		$section = parent::inspectorSection();
		$section->id 	= 'nodes';
		$section->label = new NodeLabel(['en' => 'Block formats']);

		return $section;
	}
}
