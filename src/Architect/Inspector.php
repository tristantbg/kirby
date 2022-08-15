<?php

namespace Kirby\Architect;

use Kirby\Blueprint\Node;
use Kirby\Blueprint\NodeLabelled;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Fields;

class Inspector extends NodeLabelled
{
    public function __construct(
        public string $id,
        public InspectorSections|null $sections = null,
        ...$args
    ) {
        parent::__construct($id, ...$args);
    }

	public function fields(): Fields
	{
		$fields = new Fields;

		foreach ($this->sections ?? [] as $section) {
			foreach ($section->fields ?? [] as $field) {
				$fields->__set($field->id, $field);
			}
		}

		return $fields;
	}

	public function fill(ModelWithContent $model, Node $node): static
	{
		$fields = $this->fields();
		$values = $node->toFieldValues($model, $fields);
		$fields->fill($values, true);

		return $this;
	}

	public function render(ModelWithContent $model): array
	{
		$this->defaults();

		return [
			'id'       => $this->id,
			'label'    => $this->label->render($model),
			'sections' => $this->sections?->active()->render($model),
			'value'    => $this->fields()->export()->toArray()
		];
	}

}
