<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Property;

/**
 * Related model option
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Related extends Property
{
	public function model(ModelWithContent $model)
	{
		if ($this->value === null) {
			return null;
		}

		return $model->query($this->value);
	}
}
