<?php /** @var \Kirby\Block\Block $block */ ?>
<<?= $level = $block->level()->or('h2') ?>><?= $block->text() ?></<?= $level ?>>
