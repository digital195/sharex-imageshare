<?php

  class Security {

    public static function sanitize($var) {
		return htmlspecialchars(strip_tags($var));
    }

    public static function sanitizeArray($array) {
		$sanitizedArray = array();
		
		foreach ($array as &$var) {
			$sanitizedVar = self::sanitize($var);
			array_push($sanitizedArray, $sanitizedVar);
		}
			
		return $sanitizedArray;
    }
  }

?>
