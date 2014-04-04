<?php

abstract class Session {
	
	/**
	 * Implementa autorização hierarquica básica, serve para 90% dos casos;
	 */
	const VISITOR = 0;
	const USER = 1;
	const ADMINISTRATOR = 2;
	
	private $type;
	private static $session = null;
	
	public function __construct( $type = self::VISITOR ){
		if ( !session_id() ){
			session_start();
		}
		
		// recupera dados da secao
		//~ $storedType = self::VISITOR;
		
		if ( isset( $_SESSION["type"] ) ) {
			$storedType = $_SESSION["type"];
		} else {
			$storedType = $this->authenticate();
		}
		
		if ( $storedType < $type ) {
			throw new Exception( 
					$_SERVER["SERVER_PROTOCOL"]." 401 Unauthorized",
					401);
		}
		if ( $storedType > $type ) {
			$type = $storedType;
		}
		
		$this->type = $type;
		$_SESSION["type"] = $type;
	}
	
	public function __destroy(){
		session_destroy();
	}
	
	public function getType(){
		return $this->type;
	}
	
	/**
	 * Sobreescrever com a lógica de autenticação
	 * 
	 * @return int {VISITOR, USER, ADMINISTRATOR}
	 */
	abstract function authenticate ();
	
}
