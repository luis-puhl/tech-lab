<?php

include_once( UTIL . "MysqlConnection.php" );

abstract class Model{
	
	public $id;
	private $config = array(
		"pdo" => null,
		"mysql" => array(
			"server_name" => "localhost",
			"user" => "test",
			"pwd" => "test",
			"database" => "test",
		)
	);
	
	abstract function getSelectSQL( $params = array() );
	public function load(){
		$pdo = $this->getPdo();
		
		$sql = $this->getSelectSQL();
		$param = array( "Pid" => $this->id );
		echo "<br>\nsql" . $sql . "\n<br>";
		
		$stm = $pdo->pdoPrepareExecute( $sql, $param );
		
		$stm->setFetchMode(PDO::FETCH_INTO, $this);
		$stm->fetch(PDO::FETCH_INTO);
		
		return true;
	}
	
	public function getPdo(){
		if ( !$this->config["pdo"] ){
			$pdo = new MysqlConnection( $this->config["mysql"] );
			//~ $pdo = new MysqlConnection(  );
			$this->config["pdo"] = $pdo;
		}
		return $this->config["pdo"];
	}
	public function setPdo( MysqlConnection $pdo ){
		$this->config["pdo"] = $pdo;
		return $this;
	}
	
	/* ---------------------------------------------------------------------- */
	
	public function __toArray(){
		$reflector = new ReflectionClass( $this );
		$props = $reflector->getProperties( ReflectionProperty::IS_PUBLIC );
		
		$arr = array();
		foreach ( $props as $prop ) {
			$arr[ $prop->getName() ] = $prop->getValue( $this );
		}
		
		return $arr;
	}
	public function __toString(){
		$props = $this->__toArray();
		$text = "";
		
		foreach ( $props as $prop => $value ) {
			$text .= $prop . ": " . $value . "\n";
		}
		
		return $text;
	}
	
	
}

/*
 * Model.php
 * 
 * Copyright 2014 Luís Puhl <luis@bolsista> at UNESP
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
