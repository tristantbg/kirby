<?php

namespace Kirby\Field;

use Kirby\Blueprint\Autoload;
use Kirby\Foundation\Collection;
use Kirby\Cms\ModelWithContent;

/**
 * Fields
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Fields extends Collection
{
	public const TYPE = Field::class;

	/**
	 * Find all errors in all fields
	 */
	public function errors(ModelWithContent $model, array $values = []): array
	{
		$errors = [];

		foreach ($this->data as $field) {
			$fieldErrors = $field->errors($model, $values[$field->id] ?? null);

			if (empty($fieldErrors) === false) {
				$errors[$field->id] = $fieldErrors;
			}
		}

		return $errors;
	}

	public static function factory(array $fields = []): static
	{
		$collection = new static();
		$collection->data = Autoload::collection('field', $fields);

		return $collection;
	}

	/**
	 * Validate each field until the first field that
	 * throws an exception
	 */
	public function validate(ModelWithContent $model, array $values = []): bool
	{
		foreach ($this->data as $field) {
			$field->validate($model, $values[$field->id] ?? null);
		}

		return true;
	}

}
