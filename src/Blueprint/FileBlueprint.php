<?php

namespace Kirby\Blueprint;

use Kirby\Attribute\UrlAttribute;

/**
 * File blueprint
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FileBlueprint extends Blueprint
{
	public const DEFAULT = 'files/default';

	public function __construct(
		public string $id,
		public FileBlueprintAcceptRules|null $accept = null,
		public FileBlueprintImage|null $image = null,
		public FileBlueprintOptions|null $options = null,
		public UrlAttribute|null $preview = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function accept(): FileBlueprintAcceptRules
	{
		return $this->accept ?? new FileBlueprintAcceptRules;
	}

	public function image(): FileBlueprintImage
	{
		return $this->image ?? new FileBlueprintImage;
	}

	public function options(): FileBlueprintOptions
	{
		return $this->options ?? new FileBlueprintOptions;
	}
}
