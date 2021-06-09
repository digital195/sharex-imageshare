<?php

    class ImageDto {
		use \GetSetGo\SetterGetter;
		
        public $id;

        public $link;
        public $direct;
        public $type;
        public $folder;
        public $notes;
		
		public $user;

        public $createdAt;
        public $updatedAt;

        public function __construct($id, $link, $direct, $type, $folder, $notes, $user, $createdAt, $updatedAt) {
            // parent::__construct();
            $this->id = Security::sanitize($id);

            $this->link = Security::sanitize($link);
            $this->direct = Security::sanitize($direct);
            $this->type = Security::sanitize($type);
            $this->folder = Security::sanitize($folder);
            $this->notes = Security::sanitize($notes);
            $this->user = Security::sanitize($user);

            $this->createdAt = date("Y-m-d H:i:s", strtotime(Security::sanitize($createdAt)));
            $this->updatedAt = date("Y-m-d H:i:s", strtotime(Security::sanitize($updatedAt)));
        }

    }

?>
