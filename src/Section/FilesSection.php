<?php

namespace Kirby\Section;

use Kirby\Blueprint\FilesItems;
use Kirby\Cms\Files;
use Kirby\Cms\ModelWithContent;

/**
 * Files section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FilesSection extends ModelsSection
{
	public const ITEMS = FilesItems::class;
	public const TYPE = 'files';

	public function __construct(
		public string $id,
		public string|null $template,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	/**
	 * Filter files by template and readable status
	 */
	public function applyFilters(Files $files): Files
	{
		$files = $files->template($this->template);
		$files = $files->filter('isReadable', true);

		return $files;
	}

	/**
	 * Load, filter, sort and paginate all files
	 * to show in the section
	 */
	public function models(ModelWithContent $model, array $query = []): Files
	{
		$files = $this->parent($model)->files();
		$files = $this->applyFilters($files);
		$files = $this->applySearch($files, $query);
		$files = $this->applySort($files);
		$files = $this->applyFlip($files);
		$files = $this->applyPagination($files, $query);

		return $files;
	}
}
