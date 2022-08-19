<?php

namespace Kirby\Field;

use Kirby\Cms\Find;
use Kirby\Cms\Files;
use Kirby\Blueprint\FilesItems;
use Kirby\Blueprint\FilesPickerDialog;
use Kirby\Blueprint\Uploads;
use Kirby\Cms\ModelWithContent;

/**
 * Files field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FilesField extends PickerField
{
	public const DIALOG = FilesPickerDialog::class;
	public const ITEMS  = FilesItems::class;
	public const TYPE   = 'files';

	public function __construct(
		public string $id,
		public Uploads|null $uploads = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function models(ModelWithContent $model): Files
	{
		$ids   = $model->revision()->value($this->id);
		$kirby = $model->kirby();
		$files = new Files;

		foreach ($ids ?? [] as $id) {
			if ($file = $kirby->file($id, $model)) {
				$files->add($file);
			}
		}

		return $files;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'uploads' => $this->uploads?->render($model),
		];
	}
}
