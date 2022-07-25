<?php

namespace Kirby\Blueprint;

use Kirby\Blueprint\Prop\Accept;
use Kirby\Blueprint\Prop\FileOptions;
use Kirby\Blueprint\Prop\Image;

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
	public const TYPE = 'file';

	public function __construct(
		public string $id,
		public Accept|null $accept = null,
		public Image|null $image = null,
		public FileOptions|null $options = null,
		public Url|null $preview = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public static function load(string $id): static
	{
		$config = new Config('files/' . $id);

		return static::factory($config->read() + [
			'id' => $id
		]);
	}

}
