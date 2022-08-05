<?php

namespace Kirby\Field;

use Kirby\Blueprint\NodeText;
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
		public NodeText $off,
		public NodeText $on,
	) {
	}

	public static function default(): static
	{
		return new static(
			on:  new NodeText(['*' => 'on']),
			off: new NodeText(['*' => 'off'])
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
			on:  new NodeText(['*' => $props['on']]),
			off: new NodeText(['*' => $props['off']])
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
