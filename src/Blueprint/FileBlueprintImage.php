<?php

namespace Kirby\Blueprint;

use Kirby\Cms\File;
use Kirby\Cms\ModelWithContent;

/**
 * Image object the file blueprint
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FileBlueprintImage extends Image
{
	public function fallbackColor(File $model): string
	{
		$extensions = [
			'indd'  => 'purple-400',
			'xls'   => 'green-400',
			'xlsx'  => 'green-400',
			'csv'   => 'green-400',
			'docx'  => 'blue-400',
			'doc'   => 'blue-400',
			'rtf'   => 'blue-400'
		];

		$types = [
			'image'    => 'orange-400',
			'video'    => 'yellow-400',
			'document' => 'red-400',
			'audio'    => 'aqua-400',
			'code'     => 'blue-400',
			'archive'  => 'gray-500'
		];

		return $extensions[$model->extension()] ?? $types[$model->type()] ?? 'gray-500';
	}

	public function fallbackIcon(File $model): string
	{
		$extensions = [
			'xls'   => 'table',
			'xlsx'  => 'table',
			'csv'   => 'table',
			'docx'  => 'pen',
			'doc'   => 'pen',
			'rtf'   => 'pen',
			'mdown' => 'markdown',
			'md'    => 'markdown'
		];

		$types = [
			'image'    => 'image',
			'video'    => 'video',
			'document' => 'document',
			'audio'    => 'audio',
			'code'     => 'code',
			'archive'  => 'archive'
		];

		return $extensions[$model->extension()] ?? $types[$model->type()] ?? 'file';
	}

	public function file(ModelWithContent $model)
	{
		return $this->query ? parent::file($model) : $model;
	}

	public function render(ModelWithContent $model): array|false
	{
		if ($this->disabled === true) {
			return false;
		}

		$render = parent::render($model);

		$render['back']  ??= 'pattern';
		$render['color'] ??= $this->fallbackColor($model);
		$render['icon']  ??= $this->fallbackIcon($model);

		return $render;
	}

}
