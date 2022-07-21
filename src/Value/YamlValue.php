<?php

namespace Kirby\Value;

use Kirby\Data\Yaml;

/**
 * Yaml Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class YamlValue extends ArrayValue
{
	public function __toString(): string
	{
		return Yaml::encode($this->data);
	}

	public function set(string|array|null $data = null): static
	{
		if (is_string($data) === true) {
			$data = Yaml::decode($data);
		}

		$this->data = $data;
		return $this;
	}
}
