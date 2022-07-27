<?php

use Kirby\Toolkit\I18n;

return function ($kirby) {
	$site = $kirby->site();

	return [
		'breadcrumbLabel' => function () use ($site) {
			return $site->title()->or(I18n::translate('view.site'))->toString();
		},
		'icon'      => 'home',
		'label'     => $site->blueprint()->title() ?? I18n::translate('view.site'),
		'menu'      => true,
		'dialogs'   => require __DIR__ . '/site/dialogs.php',
		'dropdowns' => require __DIR__ . '/site/dropdowns.php',
		'searches'  => require __DIR__ . '/site/searches.php',
		'views'     => require __DIR__ . '/site/views.php',
	];
};
