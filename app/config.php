<?php

/**
 * Configuração de banco de dados por maquina servidora.
 * 
 * Cada entrada aqui é de uma configuração para uma maquina servidora.
 * As máquinas são idendificadas pelo programa linux 'hostid'.
 */
$databaseServerBind = array(
	"default" => array(
		"name" => "test",
		"server" => "localhost",
		"user" => "test",
		"pwd" => "test",
		"database" => "test",
	),
);

class Config {
	const WEB_DIRECTORY = "tech-lab/";
	const ERROR_PAGE_401 = "401.php";
	const ITEMS_PER_PAGE = 10;
	
	public static function exceptionHandller ( $exception ) {
		switch ( $exception->getCode() ) {
			case 401:
				include( APP . self::ERROR_PAGE_401 );
			break;
			default:
				echo "Uncaught exception: " , $exception->getMessage(), "\n";
			break;
		}
	}
	
}

/*
 * config.php
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
