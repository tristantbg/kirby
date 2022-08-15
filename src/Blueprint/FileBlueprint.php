<?php

namespace Kirby\Blueprint;

use Kirby\Architect\Inspector;

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
	public const TYPE = 'file';

	public function __construct(
		public string $id,
		public FileBlueprintAcceptRules|null $accept = null,
		public FileBlueprintImage|null $image = null,
		public FileBlueprintOptions|null $options = null,
		public NodeUrl|null $preview = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->accept  ??= new FileBlueprintAcceptRules;
		$this->image   ??= new FileBlueprintImage;
		$this->options ??= new FileBlueprintOptions;

		parent::defaults();
	}

	public static function inspector(): Inspector
	{
		$inspector = parent::inspector();
		$inspector->sections->add(FileBlueprintImage::inspectorSection());
		$inspector->sections->add(FileBlueprintOptions::inspectorSection());

		return $inspector;
	}

	public function path(): string
	{
		return 'files/' . $this->id;
	}
}
