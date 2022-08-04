<?php

namespace Kirby\Node;

use Kirby\Cms\ModelWithContent;

/**
 * Conditions when a node will be shown
 *
 * @package   Kirby Node
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeConditions
{
	public function __construct(
		public array $conditions = []
	) {
	}

	public static function factory(array $conditions = []): static
	{
		return new static($conditions);
	}

	public function isTrue(array $data = []): bool
	{
		if (empty($this->conditions) === true) {
			return true;
		}

		foreach ($this->conditions as $key => $expected) {
			$value = $data[$key] ?? null;

			if ($value !== $expected) {
				return false;
			}
		}

		return true;
	}

	public function render(ModelWithContent $model): array
	{
		return $this->conditions;
	}
}
