<?php

namespace Kirby\Field;

use Kirby\Blueprint\Blueprints;
use Kirby\Blueprint\Prop\Icon;
use Kirby\Blueprint\Prop\Label;
use Kirby\Field\Prop\Option;
use Kirby\Field\Prop\Options;

/**
 * Position field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PositionField extends SelectField
{
	public const TYPE = 'select';

	public function options(): Options
	{
		$index   = 0;
		$options = new Options;

		foreach ($this->options ?? [] as $option) {
			$index++;
			$options->add(new Option(
				value: $index
			));

			$option->disabled = true;
			$options->add($option);
		}

		$index++;
		$options->add(new Option(
			value: $index
		));

		return $options;
	}

	public function defaults(): void
	{
		$this->empty ??= false;

		parent::defaults();
	}
}
