<?php

namespace Kirby\Attribute;

use Kirby\Cms\ModelWithContent;

/**
 * Related model option
 *
 * @package   Kirby Attribute
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class RelatedAttribute extends StringAttribute
{
	public function model(ModelWithContent $model)
	{
		return $model->query($this->value);
	}
}
