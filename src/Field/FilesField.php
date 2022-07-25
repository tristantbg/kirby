<?php

namespace Kirby\Field;

use Kirby\Field\Prop\Uploads;

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
	public const TYPE = 'files';

	public function __construct(
		public string $id,
		public Uploads|null $uploads = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}
}
