<?php

  class AdminController {

    private static $fileTypes = ['jpg','gif', 'png'];

    public static function viewImages() {
		$user = Auth::getCurrentUser();
		$imageDtos = [];
				
		$folder = $user->folder;
		$url = $user->url;
		$id = 1;
		$currentDirectory = getcwd();
		
		foreach (self::$fileTypes as &$type) {
			if (!is_dir(getcwd() . '/static/' . $folder . '/' . $type . '/')) {
				continue;
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

					if ($fileName == 'preview') {
						continue;
					}

					$urlName = explode('.', $fileName)[0];
					$createdAt = date("F d Y H:i:s.", $fileInfo->getCTime());
					$updatedAt = date("F d Y H:i:s.", $fileInfo->getATime());
					$extension = $fileInfo->getExtension();
					
					$direct = Router::getUrl() . Router::getBaseUrl() . $localPath . $fileName;
					$link = Router::getUrl() . Router::getBaseUrl() . $urlPath . $urlName;
					$preview = Router::getUrl() . Router::getBaseUrl() . $localPath . 'preview/' . $fileName;			

        			$previewDirectory = $currentDirectory . $localPath . '/preview/';
					$filePath = $currentDirectory . $localPath . '/' . $fileName;
        			$previewFilePath = $currentDirectory . $localPath . '/preview/' . $fileName;

					$imageDto = new ImageDto($id, $link, $direct, $preview, $extension, $folder, $fileName, $user->title, $createdAt, $updatedAt);

					if (!file_exists(realpath($previewFilePath)) ) {
						if (!is_dir($previewDirectory)) {
							mkdir($previewDirectory, 0755, true);
						}

						Image::resize($filePath, $previewFilePath, 300);
					}
					
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
						$imageDtos[$i]->preview,
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
