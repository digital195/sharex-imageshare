<?php

  class ViewerController {

    private static $fileExtensionsAllowed = ['png','jpg', 'jpeg', 'gif', 'webm'];

    public static function findImage($url, $typeShort, $file) {

        $folder = $url;
		$username = $url;

        $type = self::getType($typeShort);

        foreach (Config::getUsers() as &$user) {
            if ($user->url === $url) {
                $folder = $user->folder;
				$username = $user->title;
			
				if (!in_array(Router::getUrlName(), $user->allowedUrls ) && count($user->allowedUrls) > 0) {
					return Response::buildTemplate( self::noImageFound() );
				}
            }
        }

        $direct = Router::getUrl() . Router::getBaseUrl() . '/static/' . $folder . '/' . $type . '/' . $file . '.' . $type;
        $link = Router::getUrl() . Router::getBaseUrl() . '/'  . $folder . '/' . $file;

        $currentDirectory = getcwd();
        $fileLocation = $currentDirectory . '/static/' . $folder . '/' . $type . '/' . $file . '.' . $type;

        if ( ! file_exists(realpath($fileLocation)) || !in_array($type, self::$fileExtensionsAllowed)) {
            return Response::buildTemplate( self::noImageFound() );
        }

        $image = new ImageDto(-1, $link, $direct, $type, $folder, 'new', $username, date("Y-m-d H:i:s"), date("Y-m-d H:i:s") );

        return Response::buildTemplate( self::imageFound($image) );
    }
	
	private static function imageFound($imageDto) {
		$response = new ResponseDto();
		$response->setTitle('');
		
		$content =
			Builder::buildSection(
				Builder::buildLink(
					$imageDto->getDirect(),
					Builder::buildImage(
						$imageDto->getDirect(),
						$imageDto->getType()
					),
					'',
					true
				),
				'image'
			);
		
		$response->setContent($content);
		
		return $response;
	}
	
	private static function noImageFound() {
		$response = new ResponseDto();
		$response->setTitle('Error');
		
		$content =
			Builder::buildSection(
				Builder::buildText('Error - Image not found') .
				Builder::buildLineBreak() .
				Builder::buildLineBreak() .
				Builder::buildText('The image you are looking for was not found!', 'small') .
				Builder::buildLineBreak() .
				Builder::buildText('Hosted by ', 'small') .
				Builder::buildLink(
					Router::buildUrl(Config::getHost()),
					Builder::buildText(Config::getHost()),
					'small',
					false
				)
			);
		
		$response->setContent($content);
		
		return $response;
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
