<?php

  class ViewerController {

    private static $fileExtensionsAllowed = ['png','jpg', 'jpeg', 'gif', 'webm'];

    public static function findImage() {
        $requestUri = ltrim(SimpleRouter::getRequestUri(), '/');

        $requestUriSegments = explode("/", $requestUri);

        if (sizeof($requestUriSegments) == 1 && $requestUriSegments[0] == '') {
            return '';
        } else if (sizeof($requestUriSegments) <= 2 && $requestUriSegments[0] != '') {
            return self::findImageOldMethod($requestUriSegments);
        }

        $url = $requestUriSegments[0];
        $folder = $url;
		$username = $url;

        $type = self::getType($requestUriSegments[1]);
        $file = $requestUriSegments[2];

        foreach (Config::getUsers() as &$user) {
            if ($user->url === $url) {
                $folder = $user->folder;
				$username = $user->title;
			
				if (!in_array(SimpleRouter::getUrlName(), $user->allowedUrls ) && count($user->allowedUrls) > 0) {
					$error = new \stdClass();
					$error->error = true;

					return $error;
				}
            }
        }

        $direct = SimpleRouter::getUrl() . '/static/' . $folder . '/' . $type . '/' . $file . '.' . $type;
        $link = SimpleRouter::getUrl() . '/'  . $folder . '/' . $file;

        $currentDirectory = getcwd();
        $fileLocation = $currentDirectory . '/static/' . $folder . '/' . $type . '/' . $file . '.' . $type;

        if ( ! file_exists(realpath($fileLocation)) || !in_array($type, self::$fileExtensionsAllowed)) {
            $error = new \stdClass();
            $error->error = true;

            return $error;
        }

        $image = new ImageDto(-1, $link, $direct, $type, $folder, 'new', $username, date("Y-m-d H:i:s"), date("Y-m-d H:i:s") );

        return $image;
    }

    private static function findImageOldMethod($requestUriSegments) {
        $folder = 'images';

        if (sizeof($requestUriSegments) == 2) {
            $type = self::getType($requestUriSegments[0]);
            $file = $requestUriSegments[1];
        } else {
            $file = $requestUriSegments[0];
            $type = self::getType('');
        }

        $direct = SimpleRouter::getUrl() . '/static/' . $folder . '/' . $type . '/' . $file . '.' . $type;
        $link = SimpleRouter::getUrl() . '/'  . $folder . '/' . $file;

        $currentDirectory = getcwd();
        $fileLocation = $currentDirectory . '/static/' . $folder . '/' . $type . '/' . $file . '.' . $type;

        if ( ! file_exists(realpath($fileLocation)) || !in_array($type, self::$fileExtensionsAllowed)) {
            $error = new \stdClass();
            $error->error = true;

            return $error;
        }

        $image = new ImageDto(-1, $link, $direct, $type, $folder, 'old', date("Y-m-d H:i:s"), date("Y-m-d H:i:s") );

        return $image;
    }

    private static function getType($type) {
        switch($type) {
            case 'j': {
                return 'jpg'; break;
            }
            case 'je': {
                return 'jpeg'; break;
            }
            case 'p': {
                return 'png'; break;
            }
            case 'g': {
                return 'gif'; break;
            }
            default: {
                return 'png'; break;
            }
        }
    }

  }

?>
