<?php

namespace Kirby\Blueprint;

/**
 * Polyfill
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Polyfill
{
	public static function blockTypes(array $props): array
	{
		return static::replace($props, 'fieldsets', 'types');
	}

	/**
	 * Creates a wrapping tab when only columns are
	 * defined in the blueprint as a shortcut
	 */
	public static function columns(array $props, string $tabId = 'content'): array
	{
		if (isset($props['columns']) === true) {
			$props['tabs'] = [
				$tabId => [
					'columns' => $props['columns']
				]
			];

			unset($props['columns']);
		}

		return $props;
	}

	public static function drawer(array $props): array
	{
		if (isset($props['fields']) === true) {
			$props['tabs'] = [
				'content' => [
					'fields' => $props['fields']
				]
			];

			unset($props['fields']);
		}

		return $props;
	}

	/**
	 * Creates a wrapping fields section for stand-alone fields
	 */
	public static function fields(array $props, string $sectionId = null): array
	{
		// fields shortcut
		if (isset($props['fields']) === true) {
			$sectionId ??= implode('-', array_keys($props['fields']));

			// create a new wrapping content section
			$props['sections'] = [
				$sectionId => [
					'type'   => 'fields',
					'fields' => $props['fields']
				]
			];

			unset($props['fields']);
		}

		return $props;
	}

	/**
	 * Converts the simplified icon method to a full
	 * image option definition
	 */
	public static function icon(array $props): array
	{
		// move icon definition into image
		if (isset($props['icon']) === true) {
			$props['image']['icon'] = $props['icon'];
			unset($props['icon']);
		}

		return $props;
	}

	public static function replace(array $props, string $old, string $new): array
	{
		if (isset($props[$old]) === true) {
			$props[$new] ??= $props[$old];
			unset($props[$old]);
		}

		return $props;
	}

	public static function headline(array $props): array
	{
		return static::replace($props, 'headline', 'label');
	}

	/**
	 * Creates a wrapping column around stand-alone sections
	 */
	public static function sections(array $props): array
	{
		// sections shortcut
		if (isset($props['sections']) === true) {
			// create a new wrapping column
			$props['columns'] = [
				[
					'sections' => $props['sections']
				]
			];

			unset($props['sections']);
		}

		return $props;
	}

	public static function tableColumns(array $props): array
	{
		if (empty($props['columns']) === true) {
			return $props;
		}

		foreach ($props['columns'] ?? [] as $id => $column) {
			// skip columns
			if ($column === false) {
				unset($props['columns'][$id]);
			}

			// support infering the column settings
			// directly from a field
			if ($column === true) {
				$props['columns'][$id] = [
					'field' => $props['fields'][$id],
				];
			}
		}

		return $props;
	}

	public static function title(array $props): array
	{
		return static::replace($props, 'title', 'label');
	}
}
