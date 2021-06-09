<?php

  class AdminController {

    private static $fileTypes = ['jpg','gif', 'png'];

    public static function viewImages() {
		$user = Auth::getCurrentUser();
		$imageDtos = [];
				
		$folder = $user->folder;
		$url = $user->url;
		$id = 1;
		
		foreach (self::$fileTypes as &$type) {
			if (!is_dir(getcwd() . '/static/' . $folder . '/' . $type . '/')) {
				break;
			}

			$dir = new DirectoryIterator( getcwd() . '/static/' . $folder . '/' . $type . '/');
			$urlType = substr($type, 0, 1);
		
			if ($type == 'jpeg') {
				$urlType = 'je';
			}
						
			$localPath = '/static/' . $folder . '/' . $type . '/';
			$urlPath = '/' . $url . '/' . $urlType . '/';
						
			foreach ($dir as $fileInfo) {
				if (!$fileInfo->isDot()) {
					$fileName = $fileInfo->getFilename();
					$urlName = explode('.', $fileName)[0];
					$createdAt = date("F d Y H:i:s.", $fileInfo->getCTime());
					$updatedAt = date("F d Y H:i:s.", $fileInfo->getATime());
					$extension = $fileInfo->getExtension();
					
					$direct = Router::getUrl() . Router::getBaseUrl() . $localPath . $fileName;
					$link = Router::getUrl() . Router::getBaseUrl() . $urlPath . $urlName;
										
					$imageDto = new ImageDto($id, $link, $direct, $extension, $folder, $fileName, $user->title, $createdAt, $updatedAt);

					array_push($imageDtos, $imageDto);
					
					$id++;
				}
			}
		}
		
		function cmp($a, $b) {
			return strcmp($a->notes, $b->notes);
		}

		usort($imageDtos, "cmp");
		
		$imageDtos = array_reverse($imageDtos);
		
		$images = '';
		
		for($i = 0; $i < count($imageDtos); $i++) {
			$images = $images . Builder::buildFigure(
				Builder::buildLink(
					$imageDtos[$i]->link,
					Builder::buildImage(
						$imageDtos[$i]->direct,
						$imageDtos[$i]->notes
					),
					'',
					true
				) .
				Builder::buildFigCaption($imageDtos[$i]->notes)
			);
		};
		
		$response = new ResponseDto();
		$response->setTitle('Admin');
		
		$content =
			Builder::buildSection(
				Builder::buildText('Overview') .
				Builder::buildLineBreak() .
				Builder::buildSection(
					$images,
					'image-overview'
				)
			) .
			Builder::buildSection(
				Builder::buildText('Actions') .
				Builder::buildLineBreak() .
				Builder::buildLineBreak() .
				Builder::buildLink(
					Router::getBaseUrl() . '/logout',
					'Logout',
					'small',
					false
				) .
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
		
		return Response::buildTemplate($response);
    }

  }

?>
