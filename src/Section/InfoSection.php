<?php

namespace Kirby\Section;

use Kirby\Blueprint\Prop\Kirbytext;
use Kirby\Cms\ModelWithContent;
use Kirby\Enumeration\Theme;

/**
 * Info section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class InfoSection extends DisplaySection
{
	public const TYPE = 'info';

	public function __construct(
		public string $id,
		public Kirbytext|null $text = null,
		public Theme|null $theme = null,
		...$args
	) {
		parent::__construct($id, ...$args);

	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'text'  => $this->text?->render($model),
			'theme' => $this->theme?->value,
		];
	}
}
