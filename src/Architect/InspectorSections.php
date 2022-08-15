<?php

namespace Kirby\Architect;

use Kirby\Blueprint\Nodes;

class InspectorSections extends Nodes
{
    public const TYPE = InspectorSection::class;

	public function active(): static
	{
		return $this->filter(function ($section) {
			return $section->fields?->count() > 0;
		});
	}

}
