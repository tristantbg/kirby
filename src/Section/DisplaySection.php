<?php

namespace Kirby\Section;

use Kirby\Cms\ModelWithContent;
use Kirby\Blueprint\Prop\Help;
use Kirby\Blueprint\Prop\Label;

/**
 * Display section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class DisplaySection extends Section
{
	public const TYPE = 'display';

	public function __construct(
		public string $id,
		public Help|null $help = null,
		public Label|null $label = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->label ??= Label::fallback($this->id);
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'help'  => $this->help?->render($model),
			'label' => $this->label?->render($model),
		];
	}
}
