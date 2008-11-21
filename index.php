<?php

	$configFilename = 'DSN.php';
	if (!is_readable($configFilename)) {
	    header('Location: install/setup-required.php');
	}
	define('SHARED_DIR', dirname(realpath($configFilename)));
	
	define('APP_DIR', dirname(__FILE__) . '/APP');
	
	// UPLOAD_DIR 常量用于指示保存上传文件的根目录
    define('UPLOAD_DIR', dirname(__FILE__) . '/upload');
    // UPLOAD_ROOT 常量用于指示用什么 URL 路径访问上传目录
    define('UPLOAD_ROOT', 'upload');

    define('NO_LEGACY_FLEAPHP', true);
	require ('FLEA/FLEA.php');

	FLEA::loadAppInf($configFilename);
	FLEA::loadAppInf(APP_DIR . '/Config/ZOB_APP_INF.php');
	FLEA::import(APP_DIR);
	FLEA::runMVC();
?>