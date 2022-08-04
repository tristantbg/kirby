<?php

namespace Kirby\Blueprint;

use Kirby\Attribute\LabelAttribute;
use Kirby\Attribute\TextAttribute;
use Kirby\Cms\ModelWithContent;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Node\LabelledNode;

/**
 * Page Status Option
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PageBlueprintStatusOption extends LabelledNode
{
	public function __construct(
		public string $id,
		public bool $disabled = false,
		public TextAttribute|null $text = null,
		...$args
	) {
		if (in_array($this->id, ['draft', 'unlisted', 'listed']) === false) {
			throw new InvalidArgumentException('The status must be draft, unlisted or listed');
		}

		parent::__construct($id, ...$args);
	}

	public function label(): LabelAttribute
	{
		return $this->label ?? new LabelAttribute(['*' => 'page.status.' . $this->id]);
	}

	public static function prefab(string $id, array|string|bool|null $option = null): static
	{
		$option = match (true) {
			// disabled
			$option === false => [
				'disabled' => true
			],

			// use default values for the status
			$option === null, $option === true => [],

			// simple string for label. the text will be unset
			is_string($option) === true => [
				'label' => ['*' => $option],
				'text'  => ['*' => null],
			],

			// already defined as array definition
			default => $option
		};

		$option['id'] = $id;

		return static::factory($option);
	}

	public function render(ModelWithContent $model): array|false
	{
		if ($this->disabled === true) {
			return false;
		}

		return [
			'label' => $this->label()->render($model),
			'text'  => $this->text()->render($model),
		];
	}

	public function text(): TextAttribute
	{
		return $this->text ?? new TextAttribute(['*' => 'page.status.' . $this->id . '.description']);
	}
}
