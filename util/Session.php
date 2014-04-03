<?php

abstract class Session {
	
	/**
	 * Implementa autorização hierarquica básica, serve para 90% dos casos;
	 */
	const VISITOR = 0;
	const USER = 1;
	const ADMINISTRATOR = 2;
	
	private $type;
	
	function __contruct( $type = VISITOR ){
		session_start();
		// recupera dados da secao
		$storedType = self::VISITOR;
		if ( isset( $_SESSION["type"] ) {
			$storedType = $_SESSION["type"];
		} else {
			$storedType = $this->authenticate();
		}
		
		if ( $storedType < $type ) {
			header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden");
			include_once( ERROR_PAGE_403 );
		}
		$this->type = $type;
	}
	
	function getType(){
		return $this->type;
	}
	
	/**
	 * Sobreescrever com a lógica de autenticação
	 * 
	 * @return int {VISITOR, USER, ADMINISTRATOR}
	 */
	abstract function authenticate ();
	
}
