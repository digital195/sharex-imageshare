<?php

	class Config {
		use \GetSetGo\SetterGetter;

		private static $title = '';
		private static $users = [];
		private static $host = 's-loer.de';

		private static $imprint = '';
		private static $privacy = '';
		
		private static $copyright = true;

        private static $headerColors = ['#ffff00', '#ff9933'];
		private static $backgroundColors = ['#ffff00', '#ff9933'];
		private static $fontColor = '#333300';
		private static $linkColor = '#ffffff';
		
		private static $csrfTokenSecret = 'hlk$vhn$jfü';

		public static function init() {
		    // not-defined is the apiKey please change this
			array_push(self::$users, new UserDto(1, 'username', 'user1', 'folder', 'url', 'not-defined', '', ['domain1', 'domain2'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")) );
		}

	}

?>