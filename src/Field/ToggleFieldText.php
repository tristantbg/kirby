<?php

namespace Kirby\Field;

use Kirby\Attribute\TextAttribute;
use Kirby\Cms\ModelWithContent;
use Kirby\Toolkit\A;

/**
 * Toggle field text
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ToggleFieldText
{
	public function __construct(
		public TextAttribute $off,
		public TextAttribute $on,
	) {
	}

	public static function default(): static
	{
		return new static(
			on:  new TextAttribute(['*' => 'on']),
			off: new TextAttribute(['*' => 'off'])
		);
	}

	public static function factory(string|array $props = null): ?static
	{
		// the same text for both states
		if (is_string($props) === true) {
			$props = [
				'on'  => $props,
				'off' => $props
			];
		}

		// two values for both states
		if (A::isAssociative($props) === false) {
			$props = [
				'on'  => $props[1] ?? $props[0],
				'off' => $props[0],
			];
		}

		return new static(
			on:  new TextAttribute(['*' => $props['on']]),
			off: new TextAttribute(['*' => $props['off']])
		);
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'on'  => $this->on->render($model),
			'off' => $this->off->render($model),
		];
	}
}
