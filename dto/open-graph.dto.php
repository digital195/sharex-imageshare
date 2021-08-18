<?php

    class OpenGraphDto {
		use \GetSetGo\SetterGetter;
		
        private $title;
        private $description;
		private $image;
        private $url;

        public function __construct($title, $description, $image, $url) {
            // parent::__construct();
            $this->title = Security::sanitize($title);
            $this->description = Security::sanitize($description);
            $this->image = Security::sanitize($image);
            $this->url = Security::sanitize($url);
        }
		
    }

?>
