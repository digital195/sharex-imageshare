<?php

  class AuthController {

    public static function login() {
		if (READONLY) {
			// READONLY Mode
			$response = new ResponseDto();
			$response->setTitle('Readonly Mode');
			$response->setRedirectTo(Router::getBaseUrl() . '/');
			
			$content =
				Builder::buildSection(
					Builder::buildText('Readonly') .
					Builder::buildLineBreak() .
					Builder::buildLineBreak() .
					Builder::buildText('The readonly mode is active', 'small') .
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
		
		if (Auth::isLogin()) {
			// Already LoggedIn
			$response = new ResponseDto();
			$response->setTitle('Login');
			$response->setRedirectTo(Router::getBaseUrl() . '/admin/');
			
			$content =
				Builder::buildSection(
					Builder::buildText('Already logged in') .
					Builder::buildLineBreak() .
					Builder::buildLineBreak() .
					Builder::buildText('You have already logged in correctly. ', 'small') .
					Builder::buildLink(
						'/admin',
						Builder::buildText('You will now be redirected to the homepage!'),
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
			$response->setRedirectTo('/admin');
			
			return Response::buildTemplate($response);
		}
		
		if (!Auth::isLogin() && isset($_POST['submit'])) {
			$username = Security::sanitize($_POST['username']);
			$password = Security::sanitize($_POST['password']);
			
			$result = Auth::processLogin($username, $password);
			$response = new ResponseDto();
			
			$response->setTitle('Login');
			
			if ($result) {
				// Login OK
				$response->setRedirectTo(Router::getBaseUrl() . '/admin/');

				$content =
					Builder::buildSection(
						Builder::buildText('Login correct') .
						Builder::buildLineBreak() .
						Builder::buildLineBreak() .
						Builder::buildText('The login was correct! ', 'small') .
						Builder::buildLink(
							Router::getBaseUrl() . '/admin',
							Builder::buildText('You will now be redirected to the homepage!'),
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
				
			} else {
				// Login Failed
				$content =
					Builder::buildSection(
						Builder::buildText('Login failed') .
						Builder::buildLineBreak() .
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
			}
			
			return Response::buildTemplate($response);
		}
		
		// Formular
		$response = new ResponseDto();
		
		$response->setTitle('Login');
		
		$content =
			Builder::buildSection(
				Builder::buildText('Login') .
				Builder::buildLineBreak() .
				Builder::buildLineBreak() .
				Builder::buildText('Sign in with your account ', 'small') .
				Builder::buildLineBreak() .
				Builder::buildLineBreak() .
				Builder::buildForm(
					Router::getBaseUrl() . '/login',
					'POST',
					Builder::buildLabel('username', 'Username', 'small') .
					Builder::buildLineBreak() .
					Builder::buildInput('text', 'Enter Username', 'username', '', true) .
					Builder::buildLineBreak() .
					Builder::buildLabel('password', 'Password', 'small') .
					Builder::buildLineBreak() .
					Builder::buildInput('password', 'Enter Password', 'password', '', true) .
					Builder::buildLineBreak() .
					Builder::buildInput('hidden', '', 'csrf_token', Security::generateToken('login'), false, 'hidden') .
					Builder::buildInput('hidden', '', 'csrf_time_token', Security::generateTimeToken('login'), false, 'hidden') .
					Builder::buildButton('submit', 'Login', 'submit')				
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
	
	public static function logout() {
		if (READONLY) {
			// READONLY Mode
			$response = new ResponseDto();
			$response->setTitle('Readonly Mode');
			$response->setRedirectTo(Router::getBaseUrl() . '/');
			
			$content =
				Builder::buildSection(
					Builder::buildText('Readonly') .
					Builder::buildLineBreak() .
					Builder::buildLineBreak() .
					Builder::buildText('The readonly mode is active', 'small') .
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

		$result = Auth::processLogout();
		$response = new ResponseDto();
		
		$response->setRedirectTo(Router::getBaseUrl() . '/');
		
		if ($result) {
			// Logout OK
			$response->setTitle('Logout');
			$content =
				Builder::buildSection(
					Builder::buildText('Logout') .
					Builder::buildLineBreak() .
					Builder::buildLineBreak() .
					Builder::buildText('You successfully logged out. ', 'small') .
					Builder::buildLink(
						Router::getBaseUrl() . '/',
						Builder::buildText('You will now be redirected ...'),
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
		} else {
			// Logout NO
			$response->setTitle('');
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
		}
		
		return Response::buildTemplate($response);
	}

  }

?>
