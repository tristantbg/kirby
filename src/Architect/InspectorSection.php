<?php

namespace Kirby\Architect;

use Kirby\Blueprint\NodeLabelled;
use Kirby\Field\Fields;

class InspectorSection extends NodeLabelled
{
    public function __construct(
        public string $id,
        public Fields|null $fields,
        public bool $open = true,
        ...$args
    ) {
        parent::__construct($id, ...$args);
    }
}
