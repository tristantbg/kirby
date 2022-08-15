<?php

return function () {
	return [
		'icon'      => 'code',
		'label'     => 'Architect',
		'menu'      => true,
		'dialogs'   => require_once __DIR__ . '/architect/dialogs.php',
		'dropdowns' => require_once __DIR__ . '/architect/dropdowns.php',
		'views'     => require_once __DIR__ . '/architect/views.php'
	];
};
