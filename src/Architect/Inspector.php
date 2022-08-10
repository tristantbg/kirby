<?php

namespace Kirby\Architect;

use Kirby\Blueprint\NodeLabelled;

class Inspector extends NodeLabelled
{
    public function __construct(
        public string $id,
        public array $values = [],
        public InspectorSections|null $sections = null,
        ...$args
    ) {
        parent::__construct($id, ...$args);
    }
}
