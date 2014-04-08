<?php

define( "ROOT", dirname(__FILE__) . "/" );

// bibliotecas, pouca modificação com o tempo
define( "LIB", ROOT . "lib/" );

// este framework
define( "UTIL", ROOT . "util/" );
define( "ANNOTATION", UTIL . "annotation/" );
define( "ERROR_PAGE_401", UTIL . "401.php" );

// coisas que devem ser alteradas com mais frequencia
/**
 * Caminho das configurações (personalização) do aplicativo;
 */
define( "APP", ROOT . "app/" );
/**
 * Modelos do banco de dados;
 */
define( "MODEL", ROOT . "model/" );
/**
 * Scritps para teste;
 */
define( "TEST", ROOT . "util/" );
/**
 * Paginas agrupadas em módulos (HTML);
 */
define( "PAGES", ROOT . "pages/" );
/**
 * Trechos HTML usadas para compor as paginas;
 */
define( "HELPER", ROOT . "helper/" );

// A MAGNÍFICA BIBLIOTECA DE ANOTAÇÕES
include_once( LIB . "addendum/annotations.php" );

// carrega configurações
include_once( APP . "config.php" );

/**
 * Define a URL dos conteúdos:
 * 		Imagens (images)
 * 		Folha de Estilos (css)
 * 		Scripts de Browser (js)
 */
define( "WEB_ROOT", getAppURL() );
define( "IMG", WEB_ROOT . "images/" );
define( "CSS", WEB_ROOT . "css/" );
define( "JS", WEB_ROOT . "js/" );

set_exception_handler( "Config::exceptionHandller" );

function __autoload($className) {
	
	$file = $className . '.php';
	
	switch (true) {
		case file_exists( ROOT . $file ): {
			include_once( ROOT . $file );
			break;
		}
		case file_exists( APP . $file ): {
			include_once( APP . $file );
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

function getServerHTTP() {
	$serverHttp = 'http';
	if ( isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
		$serverHttp .= "s";
	}
	
	$serverHttp .= "://";
	$serverHttp .= $_SERVER["HTTP_HOST"];
	
	if ($_SERVER["SERVER_PORT"] != "80") {
		$serverHttp .= ":" . $_SERVER["SERVER_PORT"];
	}
	return $serverHttp;
}
function curPageURL() {
	$pageURL = getServerHTTP();
	$pageURL .= $_SERVER["REQUEST_URI"];
	return $pageURL;
}
function getAppURL() {
	$appUrl = getServerHTTP() . "/" . Config::WEB_DIRECTORY;
	return $appUrl;
}


function getCss ( $sheetName ) {
	$URL = CSS . $sheetName . ".css";
	$html = "\t<link rel='stylesheet' type='text/css' href='" . $URL . "' />\n";
	echo $html;
}
function getJs ( $scriptName ) {
	$URL = JS . $scriptName . ".js";
	$html = "\t<script type='text/javascript' src='" . $URL . "'></script>\n";
	echo $html;
}


header("Content-Type: text/html; charset=utf-8");

/*
 * boot.php
 * 
 * Copyright 2014 Luís Puhl <luispuhl@gmail.com> at UNESP
 * 
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 * 
 * * Redistributions of source code must retain the above copyright
 *   notice, this list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above
 *   copyright notice, this list of conditions and the following disclaimer
 *   in the documentation and/or other materials provided with the
 *   distribution.
 * * Neither the name of the unesp nor the names of its
 *   contributors may be used to endorse or promote products derived from
 *   this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 */
