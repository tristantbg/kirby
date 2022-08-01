<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Field\Prop\Options;
use Kirby\Field\Prop\OptionsApi;
use Kirby\Field\Prop\OptionsQuery;
use Kirby\Value\OptionsValue;

/**
 * Foundation for checkboxes and multiselect
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class OptionsField extends InputField
{
	public const TYPE = 'options';
	public OptionsValue $value;

	public function __construct(
		public string $id,
		public string|int|float|null $default = null,
		public int|null $max = null,
		public int|null $min = null,
		public string $separator = ',',
		public Options|OptionsApi|OptionsQuery|null $options = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new OptionsValue(
			// resolve options lazily to avoid processing
			// them on construction
			allowed: fn () => $this->options()->keys(),
			max: $this->max,
			min: $this->min,
			required: $this->required,
			separator: $this->separator,
		);
	}

	public static function factory(array $props): static
	{
		$props['options'] = match ($props['options'] ?? null) {
			'api'   => OptionsApi::factory($props['api']),
			'query' => OptionsQuery::factory($props['query']),
			default => Options::factory($props['options'])
		};

		unset($props['api']);
		unset($props['query']);

		return parent::factory($props);
	}

	public function options(): Options
	{
		return $this->options ?? new Options;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'max'     => $this->max,
			'min'     => $this->min,
			'options' => $this->options?->render($model)
		];
	}
}
