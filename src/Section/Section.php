<?php

namespace Kirby\Section;

use Kirby\Blueprint\Blueprint;
use Kirby\Blueprint\Column;
use Kirby\Blueprint\NodeFeature;
use Kirby\Blueprint\Polyfill;
use Kirby\Blueprint\Tab;
use Kirby\Exception\NotFoundException;

/**
 * Section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Section extends NodeFeature
{
	public const GROUP = 'section';
	public const TYPE  = 'section';

	public static function find(Blueprint|string $blueprintPath, Tab|string $tabId, Column|string $columnId, Section|string $sectionId): static
	{
		if (is_a($sectionId, Section::class) === true) {
			return $sectionId;
		}

		if ($section = Column::find($blueprintPath, $tabId, $columnId)->sections()->$sectionId) {
			return $section;
		}

		throw new NotFoundException('The section "' . $sectionId . '" could not be found');
	}

	public static function polyfill(array $props): array
	{
		$props = Polyfill::headline($props);
		$props = parent::polyfill($props);

		return $props;
	}
}
