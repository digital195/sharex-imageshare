<?php
	define('DEBUG', false);
	define('READONLY', true);
	define('VERSION', '0.0.9');

	if (DEBUG) {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	} else {
		ini_set('display_errors', 0);
		ini_set('display_startup_errors', 0);
	}

	include_once('dependencies/dependencies.php');

	Config::init();
	Router::init();
	Auth::init();

	Router::setMethodNotAllowed( function() {
		HomeController::home();
		// Response::error(405, 'method-not-allowed', 'method not allowed');
	});
	
	Router::setPathNotFound( function() {
		HomeController::home();
		// Response::error(404, 'not-found', 'not found');
	});

	Router::setSpamProtection( function($function, $matches, $path) {
		call_user_func_array($function, $matches);
	} );

	Router::setAllowedUsers( Config::getUsers() );

	Router::setBaseUrl( '' );

	Router::setAuthRequired( function() {
		Router::json();
		Response::error(401, 'wrong-credentials', 'wrong credentials supplied');
	});
	
	Router::setAuthDisabled( function() {
		Router::json();
		Response::error(400, 'readonly-mode', 'readonly mode is active');
	});
	





	Router::addMulti(['/'], function() {
		HomeController::home();
	}, 'get', 'none', false);

	Router::addMulti(['/([a-zA-Z0-9])/(j|s|p|g)/(.*)', '/([a-zA-Z0-9])/(j|s|p|g)/(.*)/'], function($user, $type, $name) {
		ViewerController::findImage($user, $type, $name);
	}, 'get', 'none', false);

	Router::addMulti(['/login', '/login/'], function() {
		AuthController::login();
	}, 'get,post', 'none', false);

	Router::addMulti(['/logout', '/logout/'], function() {
		AuthController::logout();
	}, 'get', 'none', false);

	Router::addMulti(['/admin', '/admin/'], function() {
		AdminController::viewImages();
	}, 'get', 'session', false);

	Router::addMulti(['/upload', '/upload/', '/upload'], function($user) {
		Router::json();
		UploadController::uploadImage($user);
	}, 'post', 'apiKey', false);

	Router::run();
?>