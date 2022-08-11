<?php

namespace Kirby\Field;

use Kirby\Blueprint\Enumeration;

/**
 * HTML Autocomplete attribute
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FieldAutocomplete extends Enumeration
{
	public static array $allowed = [
		null,
		'additional-name',
		'address-level1',
		'address-level2',
		'address-level3',
		'address-level3',
		'address-line1',
		'address-line2',
		'address-line3',
		'country',
		'country-name',
		'current-password',
		'bday',
		'bday-day',
		'bday-month',
		'bday-year',
		'cc-additional-name',
		'cc-csc',
		'cc-exp',
		'cc-exp-month',
		'cc-exp-year',
		'cc-family-name',
		'cc-given-name',
		'cc-name',
		'cc-number',
		'cc-type',
		'email',
		'family-name',
		'given-name',
		'honorific-prefix',
		'honorific-suffix',
		'impp',
		'language',
		'name',
		'new-password',
		'nickname',
		'off',
		'on',
		'one-time-code',
		'organization',
		'organization-title',
		'photo',
		'postal-code',
		'sex',
		'street-address',
		'tel',
		'tel-area-code',
		'tel-country-code',
		'tel-extension',
		'tel-local',
		'tel-national',
		'transaction-amount',
		'url',
	];

	public static function field()
	{
		$field = parent::field();

		$field->id = 'autocomplete';
		$field->label->translations = ['en' => 'Autocomplete'];

		return $field;
	}

}
