<?php

	class Auth {
		use \GetSetGo\SetterGetter;
		
		/**
		 * @setter false
		 */		
        private static $currentUser;
		
		public static function init() {
			if (self::isLogin()) {
				self::$currentUser = json_decode($_SESSION['user']);
			}
        }
		
		
		public static function isLogin() {
			if (!session_id()) {
				session_start();
			}
			
			return isset($_SESSION['user']);
		}
		
		public static function processLogin($username, $password) {
			if (self::isLogin()) {
				return true;
			}
			
			$validateToken = false;
			$csrfToken = Security::sanitize($_POST['csrf_token']);
			$csrfTimeToken = Security::sanitize($_POST['csrf_time_token']);
			
			if (Security::checkToken($csrfToken, 'login') && Security::checkTimeToken($csrfTimeToken)) {
				$validateToken = true;
			}
				
			if ($validateToken) {							
				foreach (Config::getUsers() as &$user) {
					if ($user->apiKey == $password && $user->username == $username) {
						if ($user->ip != '' && $user->ip != Router::getIp()) {
							return false;
						}
						
						$_SESSION['user'] = json_encode($user);
						self::$currentUser = $user;
						$_SERVER['REMOTE_USER'] = str_replace(' ', '-', strtolower($user->title));

						return true;
					}
				}
			}
			
			return false;
		}
		
		public static function processLogout() {
			if (self::isLogin()) {
				session_destroy();
				
				return true;
			}
			
			return false;
		}
	
	}

?>
