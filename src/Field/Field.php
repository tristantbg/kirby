<?php

namespace Kirby\Field;

use Kirby\Architect\Inspector;
use Kirby\Architect\InspectorSection;
use Kirby\Blueprint\Blueprint;
use Kirby\Blueprint\Column;
use Kirby\Blueprint\NodeFeature;
use Kirby\Blueprint\Tab;
use Kirby\Cms\ModelWithContent;
use Kirby\Exception\NotFoundException;
use Kirby\Section\Section;
use Kirby\Toolkit\Str;
use Throwable;

/**
 * Base field class
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Field extends NodeFeature
{
	public const GROUP = 'field';
	public const TYPE  = 'field';

	public function __construct(
		public string $id,
		public FieldWidth|null $width = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): static
	{
		$this->width ??= new FieldWidth();

		return parent::defaults();
	}

	public static function find(
		Blueprint|string $blueprintPath,
		Tab|string $tabId,
		Column|string $columnId,
		Section|string $sectionId,
		Field|string $fieldId
	): static {
		if (is_a($fieldId, Field::class) === true) {
			return $fieldId;
		}

		if ($field = Section::find($blueprintPath, $tabId, $columnId, $sectionId)->fields()->$fieldId) {
			return $field;
		}

		throw new NotFoundException('The field "' . $fieldId . '" could not be found');
	}

	/**
	 * Fills the field with the provided value
	 * without validating it
	 */
	public function fill(mixed $value = null): static {
		return $this;
	}

	public static function inspector(): Inspector
	{
		$inspector = parent::inspector();
		$inspector->sections->add(static::inspectorDescriptionSection());
		$inspector->sections->add(static::inspectorAppearanceSection());

		return $inspector;
	}

	public static function inspectorAppearanceSection(): InspectorSection
	{
		return new InspectorSection(
			id: 'appearance',
			fields: new Fields([
				FieldWidth::field()
			])
		);
	}

	public static function inspectorDescriptionSection(): InspectorSection
	{
		return new InspectorSection(
			id: 'description',
			fields: new Fields,
		);
	}

	public function isInput(): bool
	{
		return false;
	}

	public static function load(string|array $props): static
	{
		try {
			return parent::load($props);
		} catch (Throwable $e) {
			if (is_string($props) === true) {
				$props = ['id' => $props];
			}

			return InfoField::factory([
				'id'    => 'error-' . ($props['id'] ?? Str::random(5)),
				'label' => 'Error',
				'text'  => $e->getMessage(),
				'theme' => 'negative'
			]);
		}
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'width' => $this->width?->render($model)
		];
	}

	public function submit(
		mixed $value = null,
		ModelWithContent|null $model = null
	): static {
		return $this;
	}
}
