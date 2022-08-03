<?php

namespace Kirby\Section;

use Kirby\Enumeration\TextSize;
use Kirby\Foundation\Promise;
use Kirby\Cms\ModelWithContent;
use Kirby\Report\Reports;

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
		public Reports|Promise|null $reports = null,
		public TextSize|null $size = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'reports' => $this->reports?->render($model),
			'size'    => $this->size?->value,
		];
	}
}
