<?php

    class Auth {

        private static $users = [];
        public static $currentUser;

        public static function init() {
            self::$users = Config::getUsers();
        }

        public static function checkApiKey() {
            $apiKey = isset($_SERVER['HTTP_X_API_KEY']) ? $_SERVER['HTTP_X_API_KEY'] : 'not-defined';

            if( $apiKey == 'not-defined' ) {
                Res::error(404, 'not-found', 'not found');

                exit;
            }

            if( READONLY ) {
                Res::error(400, 'readonly-mode', 'readonly mode is active');

                exit;
            }

            foreach (self::$users as &$user) {
                if ($user->apiKey == $apiKey) {
                    if ($user->ip != '' && $user->ip != SimpleRouter::getIp()) {
                        Res::error(401, 'wrong-credentials', 'wrong credentials supplied');

                        exit;
                    }

                    self::$currentUser = $user;
                    $_SERVER['REMOTE_USER'] = str_replace(' ', '-', strtolower($user->title));

                    return true;
                }
            }

            Res::error(401, 'wrong-credentials', 'wrong credentials supplied');

            exit;
        }

    }

?>