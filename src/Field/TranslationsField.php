<?php

namespace Kirby\Field;

use Kirby\Blueprint\NodeText;
use Kirby\Cms\App;
use Kirby\Cms\Translations;
use Kirby\Option\Option;
use Kirby\Option\Options;

/**
 * Translations field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TranslationsField extends SelectField
{
	public const TYPE = 'select';

	public function __construct(
		public string $id,
		public Translations|null $translations = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->icon         ??= new FieldIcon('globe');
		$this->label        ??= new FieldLabel(['*' => 'language']);
		$this->translations ??= App::instance()->translations();
		$this->options      ??= $this->translations();

		parent::defaults();
	}

	public function translations(): Options
	{
		$options = new Options;

		foreach ($this->translations as $translation) {
			$option = new Option(
				text: new NodeText($translation->name()),
				value: $translation->code(),
			);

			$options->__set($option->value, $option);
		}

		return $options;
	}

}
