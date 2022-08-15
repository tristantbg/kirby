<?php

namespace Kirby\Field;

use Kirby\Architect\InspectorSection;
use Kirby\Blueprint\Bools;
use Kirby\Blueprint\NodeLabel;

/**
 * Marks
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class WriterFieldMarks extends Bools
{
	public function __construct(
		public bool $bold = true,
		public bool $code = true,
		public bool $email = true,
		public bool $italic = true,
		public bool $link = true,
		public bool $strike = true,
		public bool $underline = true,
	) {
	}

	public static function inspectorSection(): InspectorSection
	{
		$section = parent::inspectorSection();
		$section->id    = 'marks';
		$section->label = new NodeLabel(['en' => 'Inline formats']);

		return $section;
	}
}
