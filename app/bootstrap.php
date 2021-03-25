<?php
require_once 'config.php';
spl_autoload_register(function($class) {
	
	$fn = 'app/engine/' . $class . '.php';
	
	if (file_exists($fn)) {
		require $fn;
	} 
	
});

Route::start();