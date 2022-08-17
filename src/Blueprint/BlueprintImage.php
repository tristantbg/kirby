<?php

namespace Kirby\Blueprint;

use Kirby\Architect\InspectorSection;
use Kirby\Cms\File;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Fields;
use Kirby\Field\TextField;
use Kirby\Field\ToggleField;

/**
 * Image object for sections and fields
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class BlueprintImage
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

	public function defaults(ModelWithContent $model): void
	{
		$this->back  ??= 'pattern';
		$this->color ??= 'gray-500';
		$this->icon  ??= 'page';
		$this->query ??= 'model.image';
	}

	/**
	 * Resolves the query to a file object
	 */
	public function file(ModelWithContent $model): File|null
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

	public static function inspectorSection(): InspectorSection
	{
		return new InspectorSection(
			id: 'image',
			fields: new Fields([
				new TextField(id: 'back'),
				new TextField(id: 'color'),
				new ToggleField(id: 'cover'),
				NodeIcon::field(),
				new TextField(id: 'query'),
				new TextField(id: 'ratio'),
			])
		);
	}

	public function render(ModelWithContent $model): array|false
	{
		if ($this->disabled === true) {
			return false;
		}

		$this->defaults($model);

		return [
			'back'  => $this->back,
			'color' => $this->color,
			'cover' => $this->cover,
			'icon'  => $this->icon,
			'src'   => $this->file($model)?->url(),
			'ratio' => $this->ratio
		];
	}

	/**
	 * @return $this
	 */
	public function merge(BlueprintImage|null $image = null): static
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
