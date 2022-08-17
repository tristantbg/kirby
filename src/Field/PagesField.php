<?php

namespace Kirby\Field;

use Kirby\Blueprint\PagesItems;
use Kirby\Blueprint\PagesPickerDialog;
use Kirby\Cms\File;
use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Pages;
use Kirby\Cms\User;

/**
 * Pages field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PagesField extends PickerField
{
	public const DIALOG = PagesPickerDialog::class;
	public const ITEMS  = PagesItems::class;
	public const TYPE   = 'pages';

	public function __construct(
		public string $id,
		public bool $subpages = true,
		...$args
	) {
		parent::__construct($id, ...$args);
	}
}
