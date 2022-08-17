<?php

namespace Kirby\Blueprint;

/**
 * A blueprint note that contains a label node
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeLabelled extends Node
{
	public function __construct(
		public string $id,
		public NodeLabel|null $label = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): static
	{
		$this->label ??= $this->label();

		return parent::defaults();
	}

	public function label(): NodeLabel
	{
		return $this->label ?? NodeLabel::fallback($this->id);
	}

	public static function polyfillTitle(array $props): array
	{
		$props = Polyfill::replace($props, 'title', 'label');

		return $props;
	}
}
