<?php

namespace Kirby\Field;

use Kirby\Attribute\LabelAttribute;
use Kirby\Cms\App;
use Kirby\Cms\Roles;
use Kirby\Field\Prop\Option;
use Kirby\Field\Prop\Options;

/**
 * Roles field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class RolesField extends RadioField
{
	public const TYPE = 'radio';

	public function __construct(
		public string $id,
		public Roles|null $roles = null,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function defaults(): void
	{
		$this->label   ??= new LabelAttribute(['*' => 'role']);
		$this->roles   ??= App::instance()->roles();
		$this->options ??= $this->roles();

		parent::defaults();
	}

	public function roles(): Options
	{
		$options = new Options;

		foreach ($this->roles as $role) {
			$option = Option::factory([
				'text'  => $role->title(),
				'info'  => $role->description() ?? 'role.description.placeholder',
				'value' => $role->name()
			]);

			$options->__set($option->value, $option);
		}

		return $options;

	}
}
