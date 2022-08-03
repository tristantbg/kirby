<?php

namespace Kirby\Field;

use Kirby\Attribute\HelpAttribute;
use Kirby\Attribute\LabelAttribute;
use Kirby\Cms\ModelWithContent;

/**
 * Display field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class DisplayField extends Field
{
	public const TYPE = 'display';

	public function __construct(
		public string $id,
		public HelpAttribute|null $help = null,
		public LabelAttribute|null $label = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'help'  => $this->help?->render($model),
			'label' => $this->label?->render($model)
		];
	}
}
