<?php

namespace Kirby\Blueprint;

use Kirby\Architect\Inspector;
use Kirby\Architect\InspectorSection;
use Kirby\Field\TextField;

/**
 * Page blueprint
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PageBlueprint extends Blueprint
{
	public const DEFAULT = 'pages/default';
	public const TYPE = 'page';

	public function __construct(
		public string $id,
		public PageBlueprintImage|null $image = null,
		public PageBlueprintNavigation|null $navigation = null,
		public string|null $num = null,
		public PageBlueprintOptions|null $options = null,
		public NodeUrl|null $preview = null,
		public PageBlueprintStatus|null $status = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->image      ??= new PageBlueprintImage;
		$this->navigation ??= new PageBlueprintNavigation;
		$this->options    ??= new PageBlueprintOptions;
		$this->status     ??= new PageBlueprintStatus;
	}

	public static function inspector(): Inspector
	{
		$inspector = parent::inspector();
		$inspector->sections->add(PageBlueprintImage::inspectorSection());
		$inspector->sections->add(PageBlueprintStatus::inspectorSection());
		$inspector->sections->add(PageBlueprintOptions::inspectorSection());

		return $inspector;
	}

	public static function inspectorSettingsSection(): InspectorSection
	{
		$section = parent::inspectorSettingsSection();

		$section->fields->num     = new TextField(id: 'num');
		$section->fields->preview = NodeUrl::field()->set('id', 'preview')->set('label', 'Preview URL');

		return $section;
	}

	public function path(): string
	{
		return 'pages/' . $this->id;
	}
}
