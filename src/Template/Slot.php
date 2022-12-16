<?php

namespace Kirby\Template;

use Kirby\Exception\LogicException;

/**
 * The slot class catches all content
 * between the beginning and the end of
 * a slot. Slot content is then stored
 * in the Slots collection.
 *
 * @package   Kirby Template
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://getkirby.com/license
 */
class Slot
{
	/**
	 * Keeps track of the slot state
	 */
	protected bool $open = false;

	/**
	 * Creates a new slot for the given snippet
	 */
	public function __construct(
		protected string $name,
		public string|null $content = null
	) {
	}

	/**
	 * Renders the slot content or an empty string
	 * if the slot is empty.
	 */
	public function __toString(): string
	{
		return $this->render() ?? '';
	}

	/**
	 * Used in the slot helper
	 */
	public static function begin(string $name = 'default'): static|null
	{
		return Snippet::$current?->slot($name);
	}

	/**
	 * Closes a slot and catches all the content
	 * that has been printed since the slot has
	 * been opened
	 */
	public function close(): void
	{
		if ($this->open === false) {
			throw new LogicException('The slot has not been opened');
		}

		$this->content = ob_get_clean();
		$this->open    = false;
	}

	/**
	 * Used in the endslot() helper
	 */
	public static function end(): void
	{
		Snippet::$current?->endslot();
	}

	/**
	 * Returns whether the slot is currently
	 * open and being buffered
	 */
	public function isOpen(): bool
	{
		return $this->open;
	}

	/**
	 * Returns the slot name
	 */
	public function name(): string
	{
		return $this->name;
	}

	/**
	 * Opens the slot and starts
	 * output buffering
	 */
	public function open(): void
	{
		$this->open = true;

		// capture the output
		ob_start();
	}

	/**
	 * Returns the slot content
	 */
	public function render(): string|null
	{
		return $this->content;
	}
}
