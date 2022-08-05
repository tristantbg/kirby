<?php

namespace Kirby\Field;

use Kirby\Blueprint\BlueprintImage;
use Kirby\Blueprint\NodeText;
use Kirby\Cms\ModelWithContent;
use Kirby\Section\SectionLayout;
use Kirby\Section\SectionSize;
use Kirby\Value\YamlValue;

/**
 * Picker field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PickerField extends InputField
{
	public const TYPE = 'picker';
	public YamlValue $value;

	public function __construct(
		public string $id,
		public array|null $default = null,
		public NodeText|null $empty = null,
		public BlueprintImage|null $image = null,
		public NodeText|null $info = null,
		public SectionLayout|null $layout = null,
		public int $limit = 20,
		public bool $link = true,
		public int|null $max = null,
		public int|null $min = null,
		public bool $multiple = true,
		public string|null $query = null,
		public bool $search = true,
		public SectionSize|null $size = null,
		public NodeText|null $text = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		if ($this->multiple === false) {
			$this->max = 1;
		}

		$this->value = new YamlValue(
			max: $this->max,
			min: $this->min,
			required: $this->required
		);
	}

	public function defaults(): void
	{
		$this->layout ??= new SectionLayout;
		$this->size   ??= new SectionSize;

		parent::defaults();
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'empty'    => $this->empty?->render($model),
			'layout'   => $this->layout?->render($model),
			'multiple' => $this->multiple,
		];
	}

	public function dialogs()
	{
	}

	public function routes(ModelWithContent $model): array
	{
		return [
			[
				'pattern' => '/',
				'action'  => function (array $query = []) {
				}
			]
		];
	}

}
