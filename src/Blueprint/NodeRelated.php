<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Related model option
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeRelated extends NodeString
{
	public function model(ModelWithContent $model)
	{
		return $model->query($this->value);
	}
}
