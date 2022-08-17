<?php

namespace Kirby\Blueprint;

class FilesItems extends Items
{
	public function defaults(): static
	{
		$this->empty ??= new NodeText(['*' => 'files.empty']);
		$this->image ??= new FileBlueprintImage;
		$this->text  ??= new NodeText(['*' => '{{ file.filename }}']);

		return parent::defaults();
	}
}
