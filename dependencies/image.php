<?php

  use \Gumlet\ImageResize;
  use \Gumlet\ImageResizeException;

  class Image {

    public static function init() {

    }

    public static function check($file) {
      try {
        $image = new ImageResize($file);
        return true;
      } catch (ImageResizeException $e) {
        return false;
      }
    }

    public static function resize($file, $name, $width) {
      try {
        $image = new ImageResize($file);
        $image->resizeToWidth($width);
        $image->quality_jpg = 90;
        $image->gamma(false);
        $image->save($name);

        return true;
      } catch (ImageResizeException $e) {
        return false;
     }
    }

    public static function crop($file, $name, $width, $height) {
      try {
        $image = new ImageResize($file);
        $image->crop($width, $height);
        $image->quality_jpg = 90;
        $image->gamma(false);
        $image->save($name);

        return true;
      } catch (ImageResizeException $e) {
        return false;
     }
    }

    public static function delete($file) {
      if (file_exists($file)) {
       unlink($file);

       return true;
      } else {
        return false;
      }
    }

  }

?>
