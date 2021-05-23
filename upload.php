<?php
	define('DEBUG', false);
	define('READONLY', false);
	define('VERSION', '0.0.6');

	if (DEBUG) {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	} else {
		ini_set('display_errors', 0);
		ini_set('display_startup_errors', 0);
	}

	include_once('dependencies/dependencies.php');

    SimpleRouter::init();
	Config::init();
	Auth::init();

	if (SimpleRouter::getMethod() != 'POST') {
        Res::error(405, 'method-not-allowed', 'method not allowed');
        exit;
	}

	Auth::checkApiKey();

	UploadController::uploadImage();
?>