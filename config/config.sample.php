<?php

	class Config {

		private static $title = '';
		private static $users = [];
		private static $host = '...';

		private static $imprint = '';
		private static $privacy = '';
		
		private static $copyright = true;

        private static $headerColors = ['#ffff00', '#ff9933'];
		private static $backgroundColors = ['#ffff00', '#ff9933'];
		private static $fontColor = '#333300';
		private static $linkColor = '#ffffff';

		public static function init() {
		    // not-defined is the apiKey please change this
			array_push(self::$users, new UserDto(1, 'user1', 'folder', 'url', 'not-defined', '', [], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")) );
		}

		public static function getUsers() {
			return self::$users;
		}

		public static function getHost() {
			return self::$host;
		}

		public static function getTitle() {
			return self::$title;
		}

		public static function getHeaderColors() {
			return self::$headerColors;
		}

		public static function getBackgroundColors() {
			return self::$backgroundColors;
		}

		public static function getFontColor() {
			return self::$fontColor;
		}

		public static function getLinkColor() {
			return self::$linkColor;
		}

		public static function getImprint() {
			return self::$imprint;
		}

		public static function getPrivacy() {
			return self::$privacy;
		}

		public static function getCopyright() {
			return self::$copyright;
		}
	}

?>