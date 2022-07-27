<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Component;

/**
 * Image object for sections and fields
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Image extends Component
{
	public function __construct(
		public string|null $back = null,
		public string|null $color = null,
		public bool|null $cover = null,
		public bool|null $disabled = null,
		public string|null $icon = null,
		public string|null $query = null,
		public string|null $ratio = null
	) {
	}

	public function file(ModelWithContent $model)
	{
		return $model->query($this->query, 'Kirby\Cms\File');
	}

	public static function factory(array|string|bool|null $image = null): static
	{
		$image = match (true) {
			// default image setup
			$image === true, $image === null => [],

			// disabled image
			$image === false => [
				'disabled' => true
			],

			// image query
			is_string($image) === true => [
				'query' => $image
			],

			// array definition
			default => $image
		};

		return new static(...$image);
	}

	public function render(ModelWithContent $model): array|false
	{
		if ($this->disabled === true) {
			return false;
		}

		return [
			'back'  => $this->back,
			'color' => $this->color,
			'cover' => $this->cover,
			'icon'  => $this->icon,
			'src'   => $this->file($model)?->url(),
			'ratio' => $this->ratio
		];
	}

	public function merge(Image|null $image = null): static
	{
		if ($image === null) {
			return $this;
		}

		foreach (get_object_vars($this) as $key => $value) {
			$this->$key = $image->$key ?? $value;
		}

		return $this;
	}
}
