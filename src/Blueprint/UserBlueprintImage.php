<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Image object for users
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class UserBlueprintImage extends BlueprintImage
{
	public function __construct(
		...$args
	) {
		parent::__construct(...$args);
	}

	public function defaults(ModelWithContent $model): void
	{
		$this->back  ??= 'black';
		$this->cover ??= true;
		$this->icon  ??= 'user';
		$this->query ??= 'user.avatar';
		$this->ratio ??= '1/1';

		parent::defaults($model);
	}

}
