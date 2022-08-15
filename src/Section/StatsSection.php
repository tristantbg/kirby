<?php

namespace Kirby\Section;

use Kirby\Architect\InspectorSection;
use Kirby\Blueprint\Promise;
use Kirby\Cms\ModelWithContent;

/**
 * Stats section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class StatsSection extends DisplaySection
{
	public const TYPE = 'stats';

	public function __construct(
		public string $id,
		public StatsSectionReports|null $reports = null,
		public StatsSectionSize|null $size = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public static function inspectorAppearanceSection(): InspectorSection
	{
		$section = parent::inspectorAppearanceSection();
		$section->fields->size = StatsSectionSize::field();

		return $section;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'reports' => $this->reports?->render($model),
			'size'    => $this->size?->value,
		];
	}
}
