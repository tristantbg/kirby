<?php

namespace Kirby\Section;

use Kirby\Node\Nodes;
use Kirby\Field\Fields;

/**
 * Sections
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Sections extends Nodes
{
	public const TYPE = Section::class;

	public static function nodeFactoryById(string|int $id): Section
	{
		return static::nodeFactoryByArray($id, [
			'id'   => $id,
			'type' => $id
		]);
	}

	/**
	 * Collect all fields in all sections
	 */
	public function fields(): Fields
	{
		$fields = new Fields;

		foreach ($this->data as $section) {
			if (is_a($section, FieldsSection::class) === false) {
				continue;
			}

			foreach ($section->fields ?? [] as $field) {
				$fields->__set($field->id, $field);
			}
		}

		return $fields;
	}
}
