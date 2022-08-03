<?php

namespace Kirby\Field;

use Kirby\Attribute\IconAttribute;
use Kirby\Attribute\LabelAttribute;
use Kirby\Attribute\TextAttribute;
use Kirby\Cms\App;
use Kirby\Cms\Translations;
use Kirby\Field\Prop\Option;
use Kirby\Field\Prop\Options;

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
		$this->icon         ??= new IconAttribute('globe');
		$this->label        ??= new LabelAttribute(['*' => 'language']);
		$this->translations ??= App::instance()->translations();
		$this->options      ??= $this->translations();

		parent::defaults();
	}

	public function translations(): Options
	{
		$options = new Options;

		foreach ($this->translations as $translation) {
			$option = new Option(
				text: new TextAttribute($translation->name()),
				value: $translation->code(),
			);

			$options->__set($option->value, $option);
		}

		return $options;
	}

}
