<?php

    class ResponseDto {
		use \GetSetGo\SetterGetter;
		
        private $title;
        private $content;
		private $redirectTo;
        private $openGraph;

        public function __construct() {
            // parent::__construct();
        }
		
    }

?>
