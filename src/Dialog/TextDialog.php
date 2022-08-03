<?php

namespace Kirby\Dialog;

use Kirby\Attribute\TextAttribute;

/**
 * Text Dialog
 *
 * @package   Kirby Dialog
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextDialog extends Dialog
{
	public function __construct(
		public string $id,
		public TextAttribute|null $text = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}
}
