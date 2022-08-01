<?php

namespace Kirby\Field;

use Kirby\Blueprint\Blueprints;
use Kirby\Blueprint\Prop\Icon;
use Kirby\Blueprint\Prop\Label;
use Kirby\Blueprint\Prop\Text;
use Kirby\Field\Prop\Option;
use Kirby\Field\Prop\Options;

/**
 * Blueprints field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlueprintsField extends SelectField
{
	public const TYPE = 'select';

	public function __construct(
		public string $id,
		public Blueprints|null $blueprints = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function blueprints(): Options
	{
		$options = new Options;

		foreach ($this->blueprints ?? [] as $blueprint) {
			$option = new Option(
				text: $blueprint->label,
				value: $blueprint->id,
			);

			$options->__set($option->value, $option);
		}

		return $options;
	}

	public function defaults(): void
	{
		$this->icon    ??= new Icon('template');
		$this->label   ??= new Label(['*' => 'template']);
		$this->options ??= $this->blueprints();

		parent::defaults();
	}
}
