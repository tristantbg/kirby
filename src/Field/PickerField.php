<?php

namespace Kirby\Field;

use Kirby\Attribute\TextAttribute;
use Kirby\Blueprint\Image;
use Kirby\Cms\ModelWithContent;
use Kirby\Enumeration\ItemLayout;
use Kirby\Enumeration\ItemSize;
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
		public TextAttribute|null $empty = null,
		public Image|null $image = null,
		public TextAttribute|null $info = null,
		public ItemLayout|null $layout = null,
		public int $limit = 20,
		public bool $link = true,
		public int|null $max = null,
		public int|null $min = null,
		public bool $multiple = true,
		public string|null $query = null,
		public bool $search = true,
		public ItemSize|null $size = null,
		public TextAttribute|null $text = null,
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
		$this->layout ??= new ItemLayout;
		$this->size   ??= new ItemSize;
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
