<?php

	include_once('dependencies/reader/reader.php');
	include_once('dependencies/reader/reader-exception.php');

	include_once('dependencies/setter-getter/setter-getter.php');
	include_once('dependencies/setter-getter/setter-getter-exception.php');

	include_once('dependencies/image-resize/image-resize.php');
	include_once('dependencies/image-resize/image-resize-exception.php');

	include_once('config/config.php');

	include_once('dependencies/log.php');
	include_once('dependencies/security.php');
	
	include_once('dependencies/auth.php');
	
	include_once('dependencies/response.php');
	include_once('dependencies/image.php');
	include_once('dependencies/builder.php');
	
	include_once('dependencies/router.php');

	include_once('dto/user.dto.php');
	include_once('dto/image.dto.php');
	include_once('dto/response.dto.php');
	include_once('dto/open-graph.dto.php');
	
	include_once('controller/viewer.controller.php');
	include_once('controller/upload.controller.php');
	include_once('controller/resizer.controller.php');
	include_once('controller/admin.controller.php');
	include_once('controller/auth.controller.php');
	include_once('controller/home.controller.php');
	
?>
