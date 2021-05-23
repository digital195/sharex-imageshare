<?php

    class SimpleRouter {

        public static function init() {
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Access-Control-Max-Age: 3600");
            header("Access-Control-Allow-Headers: Content-Type, origin, Access-Control-Allow-Headers, Authorization, X-Requested-With");
            header("Content-Type: application/json; charset=UTF-8");
        }

        public static function getIp() {
            return $ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        }

        public static function getMethod() {
            return $_SERVER['REQUEST_METHOD'];
        }

        public static function buildUrl($domain) {
            return 'https://' . $domain;
        }

        public static function getUrl() {
            return 'https://' . $_SERVER['HTTP_HOST'];
        }

        public static function getUrlName() {
            return $_SERVER['HTTP_HOST'];
        }

        public static function getRequestUri() {
            return $_SERVER['REQUEST_URI'];
        }
		
    }

?>