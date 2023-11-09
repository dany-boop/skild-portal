<?php
	function getPost($param) {
		return isset($_POST[$param]) ? $_POST[$param] : '';
	}

	session_start();
	session_destroy();

	$whitelist = array('127.0.0.1', '::1');
	$appPath = '/';

	if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
		$basePath = '/skild-portal/public';
		$appPath = '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $basePath . '/';
	}

	if ( isset($_SERVER["HTTP_REFERER"]) ) {
		$returnUrl = $appPath; // return to home
	}

	header("Location: " . 'signin'); 
	exit();
?>