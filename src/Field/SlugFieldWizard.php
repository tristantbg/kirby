<?php

namespace Kirby\Field;

use Kirby\Blueprint\Factory;
use Kirby\Blueprint\NodeText;
use Kirby\Cms\ModelWithContent;

/**
 * Slug field wizard
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class SlugFieldWizard
{
	public function __construct(
		public string $field,
		public NodeText $text
	) {
	}

	public static function factory(array $props): static
	{
		$props = Factory::apply($props, [
			'text' => NodeText::class
		]);

		return new static(...$props);
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'field' => $this->field,
			'text'  => $this->text->render($model)
		];
	}
}
