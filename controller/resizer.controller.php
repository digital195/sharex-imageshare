<?php

  class ResizerController {

    private static $fileExtensionsAllowed = ['png','jpg', 'jpeg'];

    public static function resizer() {
        $response = new ResponseDto();
		$response->setTitle('WIP');
		
		$content =
			Builder::buildSection(
				Builder::buildText('Readonly') .
				Builder::buildLineBreak() .
				Builder::buildLineBreak() .
				Builder::buildText('This feature is under development', 'small') .
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

  }

?>
