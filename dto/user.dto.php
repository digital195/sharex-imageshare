<?php

    class UserDto {
		use \GetSetGo\SetterGetter;
		
        public $id;

        public $username;
        public $title;
        public $folder;
        public $url;
        public $apiKey;
        public $ip;
        public $allowedUrls;

        public $createdAt;
        public $updatedAt;

        public function __construct($id, $username, $title, $folder, $url, $apiKey, $ip, $allowedUrls, $createdAt, $updatedAt) {
            // parent::__construct();
            $this->id = Security::sanitize($id);

            $this->username = Security::sanitize($username);
            $this->title = Security::sanitize($title);
            $this->folder = Security::sanitize($folder);
            $this->url = Security::sanitize($url);
            $this->apiKey = Security::sanitize($apiKey);
            $this->ip = Security::sanitize($ip);
            $this->allowedUrls = Security::sanitizeArray($allowedUrls);
			
            $this->createdAt = date("Y-m-d H:i:s", strtotime(Security::sanitize($createdAt)));
            $this->updatedAt = date("Y-m-d H:i:s", strtotime(Security::sanitize($updatedAt)));
        }

    }

?>
