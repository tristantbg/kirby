<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;

/**
 * Tags field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TagsField extends OptionsField
{
	public const TYPE = 'tags';

	public function __construct(
		public string $id,
		public bool $any = true,
		public FieldIcon|null $icon = null,
		public bool $list = false,
		...$args
	) {
		parent::__construct($id, ...$args);

		// don't validate options if any tags are accepted
		if ($this->any === true) {
			$this->value->allowed = null;
		}
	}

	public static function polyfill(array $props): array
	{
		if (($props['accept'] ?? null) === 'options') {
			$props['any'] = false;
		}

		if (($props['layout'] ?? null) === 'list') {
			$props['list'] = true;
		}

		unset($props['accept'], $props['layout']);

		return $props;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'any'  => $this->any,
			'icon' => $this->icon?->render($model),
			'list' => $this->list
		];
	}
}
