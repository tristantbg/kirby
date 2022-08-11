<?php

namespace Kirby\Field;

use Kirby\Architect\Inspector;
use Kirby\Architect\InspectorSection;
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
		public FieldHelp|null $help = null,
		public FieldLabel|null $label = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->label ??= FieldLabel::fallback($this->id);

		parent::defaults();
	}

	public function inspector(): Inspector
	{
		$inspector = parent::inspector();
		$inspector->sections->add(
			new InspectorSection(
				id: 'description',
				fields: new Fields([
					FieldLabel::field(),
					FieldHelp::field()
				])
			)
		);

		return $inspector;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'help'  => $this->help?->render($model),
			'label' => $this->label?->render($model)
		];
	}
}
