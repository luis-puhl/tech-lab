<?php

define( "ROOT", dirname(__FILE__) . "/" );

// bibliotecas, pouca modificação com o tempo
define( "LIB", ROOT . "lib/" );
// este framework
define( "UTIL", ROOT . "util/" );
define( "ANNOTATION", UTIL . "annotation/" );

// coisas que devem ser alteradas com mais frequencia
define( "MODEL", ROOT . "model/" );
define( "TEST", ROOT . "util/" );

// A MAGNÍFICA BIBLIOTECA DE ANOTAÇÕES
include_once( LIB . "addendum/annotations.php" );


function __autoload($className) {
	
	$file = $className . '.php';
	
	switch (true) {
		case file_exists( ROOT . $file ): {
			include_once( ROOT . $file );
			break;
		}
		case file_exists( LIB . $file ): {
			include_once( LIB . $file );
			break;
		}
		case file_exists( UTIL . $file ): {
			include_once( UTIL . $file );
			break;
		}
		case file_exists( ANNOTATION . $file ): {
			include_once( ANNOTATION . $file );
			break;
		}
		case file_exists( MODEL . $file ): {
			include_once( MODEL . $file );
			break;
		}
		case file_exists( TEST . $file ): {
			include_once( TEST . $file );
			break;
		}
		default:{
			return false;
		}
	}
	
	return true;
}


header("Content-Type: text/html; charset=utf-8");
