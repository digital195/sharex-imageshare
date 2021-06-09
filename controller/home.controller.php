<?php

  class HomeController {

    public static function home() {
        $response = new ResponseDto();
		$response->setTitle('');

		if (Router::getRequestUri() != Router::getBaseUrl() . '/') {
			$response->setRedirectTo(Router::getBaseUrl() . '/');
		}
		
		$content =
			Builder::buildSection(
				Builder::buildText('Imageshare') .
				Builder::buildLineBreak() .
				Builder::buildLineBreak() .
				Builder::buildText('A ShareX image hosting solution for your own domain', 'small') .
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