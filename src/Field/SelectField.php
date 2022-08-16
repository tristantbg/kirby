<?php

namespace Kirby\Field;

use Kirby\Architect\InspectorSection;
use Kirby\Cms\ModelWithContent;

/**
 * Select field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class SelectField extends OptionField
{
	public const TYPE = 'select';

	public function __construct(
		public string $id,
		public bool|null $empty = null,
		public FieldIcon|null $icon = null,
		public FieldPlaceholder|null $placeholder = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->empty ??= false;
		$this->icon  ??= new FieldIcon('angle-down');

		parent::defaults();
	}

	public static function inspectorDescriptionSection(): InspectorSection
	{
		$section = parent::inspectorDescriptionSection();

		$section->fields->placeholder = FieldPlaceholder::field();
		$section->fields->icon        = FieldIcon::field();

		return $section;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'empty'       => $this->empty,
			'icon'        => $this->icon?->render($model),
			'placeholder' => $this->placeholder?->render($model),
		];
	}
}
