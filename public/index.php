<?php require_once 'vendor/autoload.php'; ?>
<?php require_once 'includes/appstart.php'; ?>
<?php require_once 'includes/functions.php'; ?>
<?php require_once 'includes/function_layouts.php'; ?>
<?php require_once 'includes/router.php'; ?>

<?php


	// only shows error on localhost
	if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}
	
	if ($match === false) {
		// require_once '404.php';
		_404(); // redirect instead of loading 404.php

	} else {
		
		require_once 'includes/clientstart.php';
		require_once 'includes/globals.php';

		require_once $match['target'];

	}

	
?>