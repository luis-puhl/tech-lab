<?php

define( "ROOT", dirname(__FILE__) . "/" );
define( "WEB_ROOT", "/" );

// bibliotecas, pouca modificação com o tempo
define( "LIB", ROOT . "lib/" );

// este framework
define( "UTIL", ROOT . "util/" );
define( "ANNOTATION", UTIL . "annotation/" );
define( "IMG", ROOT . "images/" );
define( "ERROR_PAGE_403", UTIL . "403.php" );

// coisas que devem ser alteradas com mais frequencia
define( "MODEL", ROOT . "model/" );
define( "TEST", ROOT . "util/" );


// A MAGNÍFICA BIBLIOTECA DE ANOTAÇÕES
include_once( LIB . "addendum/annotations.php" );

// carrega configurações
include_once( UTIL . "config.php" );


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
