<?php

namespace Kirby\Section;

use Kirby\Architect\Inspector;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Field;
use Kirby\Field\Fields;

/**
 * Fields section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FieldsSection extends Section
{
	public const TYPE = 'fields';

	public function __construct(
		public string $id,
		public Fields|null $fields = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function field(string $id): ?Field
	{
		return $this->fields()->$id;
	}

	public function fields(): Fields
	{
		return $this->fields ?? new Fields;
	}

	public function inspector(): Inspector
	{
		$inspector = parent::inspector();

		return $inspector;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'fields' => $this->fields?->render($model),
		];
	}
}
