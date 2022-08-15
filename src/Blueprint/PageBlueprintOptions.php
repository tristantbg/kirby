<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Page Blueprint options
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PageBlueprintOptions extends BlueprintOptions
{
	public const ALIASES = [
		'status'   => 'changeStatus',
		'template' => 'changeTemplate',
		'title'    => 'changeTitle',
		'url'      => 'changeSlug',
	];

	public function __construct(
		public BlueprintOption|null $changeSlug = null,
		public BlueprintOption|null $changeStatus = null,
		public BlueprintOption|null $changeTemplate = null,
		public BlueprintOption|null $changeTitle = null,
		public BlueprintOption|null $create = null,
		public BlueprintOption|null $delete = null,
		public BlueprintOption|null $duplicate = null,
		public BlueprintOption|null $preview = null,
		public BlueprintOption|null $read = null,
		public BlueprintOption|null $update = null,
	) {
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'changeSlug'     => $this->changeSlug?->render($model),
			'changeStatus'   => $this->changeStatus?->render($model),
			'changeTemplate' => $this->changeTemplate?->render($model),
			'changeTitle'    => $this->changeTitle?->render($model),
			'create'    	 => $this->create?->render($model),
			'delete'         => $this->delete?->render($model),
			'duplicate'      => $this->duplicate?->render($model),
			'preview'        => $this->preview?->render($model),
			'read'           => $this->read?->render($model),
			'update'         => $this->update?->render($model),
		];
	}
}
