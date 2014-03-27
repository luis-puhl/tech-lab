<?php

define( "ROOT", dirname(__FILE__) . "/" );
define( "LIB", ROOT . "lib/" );

define( "UTIL", ROOT . "util/" );
define( "UTIL", ROOT . "util/" );

define( "MODEL", ROOT . "model/" );

function __autoload($className) {
	if (file_exists($className . '.php')) {
		require_once $className . '.php';
		return true;
	}
	return false;
}


header("Content-Type: text/html; charset=utf-8");
