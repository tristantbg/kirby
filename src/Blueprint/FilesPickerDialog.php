<?php

namespace Kirby\Blueprint;

use Kirby\Cms\File;
use Kirby\Cms\Files;
use Kirby\Cms\ModelWithContent;

/**
 * Files Picker Dialog
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FilesPickerDialog extends PickerDialog
{
	public const ITEMS = FilesItems::class;

	public function component(): string
	{
		return 'k-picker-dialog';
	}

	public function models(ModelWithContent $model, array $query = []): Files
	{
		$models = match (true) {
			// with query
			$this->query !== null => $model->query($this->query),

			// files don't have "sub-files"
			is_a($model, File::class) === true => $model->siblings(false),

			// just take all the files of the model
			default => $model->files(),
		};

		$models = $this->applySearch($models, $query);
		$models = $this->applyPagination($models, $query);

		return $models;
	}
}
