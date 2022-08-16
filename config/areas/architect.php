<?php

return function () {
	return [
		'icon'      => 'code',
		'label'     => 'Architect',
		'menu'      => true,
		'dialogs'   => require __DIR__ . '/architect/dialogs.php',
		'dropdowns' => require __DIR__ . '/architect/dropdowns.php',
		'views'     => require __DIR__ . '/architect/views.php'
	];
};
