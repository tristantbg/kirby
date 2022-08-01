<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;

/**
 * Radio field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class RadioField extends OptionField
{
	public const TYPE = 'radio';

	public function __construct(
		public string $id,
		public int $columns = 1,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'columns' => $this->columns
		];
	}
}
