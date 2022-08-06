<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Value\HtmlValue;

/**
 * List field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ListField extends InputField
{
	public const TYPE = 'list';
	public HtmlValue $value;

	public function __construct(
		public string $id,
		public WriterFieldMarks|null $marks = null,
		...$args
	) {
		parent::__construct($id, ...$args);
		$this->value = new HtmlValue();
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'marks' => $this->marks?->render($model),
		];
	}
}
