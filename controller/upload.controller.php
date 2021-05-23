<?php

  class UploadController {

    private static $fileExtensionsAllowed = ['png','jpg', 'jpeg', 'gif', 'webm'];

    public static function init() {

    }

    public static function uploadImage() {
        $user = Auth::$currentUser;

        $fileName = $_FILES['image']['name'];
        $saveName = $fileName;
        $urlName = explode('.', $fileName)[0];
        $fileSize = $_FILES['image']['size'];
        $fileTmpName  = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
        $fileExtension = strtolower(explode('.',$fileName)[1]);
        $urlType = substr($fileExtension, 0, 1);
		
		if ($fileExtension == 'jpeg') {
			$urlType = 'je';
		}

        $currentDirectory = getcwd();
        $uploadDirectory = '/static/' . $user->folder . '/' . $fileExtension . '/';
        $localPath = '/static/' . $user->folder . '/' . $fileExtension . '/';

        $urlPath = '/' . $user->url . '/' . $urlType . '/';

        if (!is_dir($currentDirectory . $uploadDirectory)) {
            mkdir($currentDirectory . $uploadDirectory, 0755, true);
        }

        $uploadPath = $currentDirectory . $uploadDirectory . basename($saveName);

        $size = getimagesize($fileTmpName);
        if (empty($size) || ($size[0] === 0) || ($size[1] === 0)) {
            return Res::error(400, 'wrong-file-supplied', 'wrong file supplied, the file should not be emptry');
        }

        if (!in_array($fileExtension, self::$fileExtensionsAllowed)) {
            return Res::error(400, 'wrong-file-supplied', 'wrong file supplied, the type is not allowed');
        }

        if ($fileSize > 30000000) {
            return Res::error(400, 'file-to-big', 'the supplied file is to big, max 30mb');
        }

        if ( file_exists(realpath($uploadPath)) ) {
            $saveName = time() . $saveName;
            $urlName = time() . $urlName;
            $uploadPath = $currentDirectory . $uploadDirectory . basename($saveName);
        }

        $success = move_uploaded_file($fileTmpName, $uploadPath);

        if (!$success) {
          return Res::error(400, 'file-move-failed', 'file could not be moved, maybe permission issue');
        }

        $direct = SimpleRouter::getUrl() . $localPath . $saveName;
        $link = SimpleRouter::getUrl() . $urlPath . $urlName;

        $image = new ImageDto(-1, $link, $direct, $fileExtension, $user->url, 'new', $user->title, date("Y-m-d H:i:s"), date("Y-m-d H:i:s") );

        Res::build(201, $image, 'CREATED');
    }

  }

?>
