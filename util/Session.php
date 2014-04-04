<?php

class httpError401 extends Exception {
	public function __construct( $message = "",
			$code = 401,
			Exception $previous = NULL)
	{
		if ( $message == "" ){
			$message = $_SERVER["SERVER_PROTOCOL"]." 401 Unauthorized";
		}
		parent::__construct( $message, $code, $previous );
	} 
}

abstract class Session {
	
	/**
	 * Implementa autorização hierarquica básica, serve para 90% dos casos;
	 */
	const VISITOR = 0;
	const USER = 1;
	const ADMINISTRATOR = 2;
	
	private static $type;
	
	public static function start( Session $customSession, $type = self::VISITOR ){
		
		// se não tem sessão, cria uma
		if ( !session_id() ){
			session_start();
		} 
		
		/*
		 * Recupera o tipo de sessao, pela sessao em si ou por autenticação
		 */
		if ( isset( $_SESSION["type"] ) ) {
			$storedType = $_SESSION["type"];
		} else {
			$storedType = $customSession->authenticate( $type );
		}
		
		/*
		 * Se na tentativa de acessar uma página, a autorização do 
		 * requisitante ($storedType) for menor que a autorização solicitada
		 * pela página ($type), gera um erro 401, não autorizado.
		 */
		if ( $storedType < $type ) {
			throw new httpError401( );
		}
		
		/*
		 * Se o usuario da sessao atual recebeu autorização maior, usa a maior.
		 */
		if ( $storedType > $type ) {
			$type = $storedType;
		}
		
		self::$type = $type;
		$_SESSION["type"] = $type;
		
		return $type;
	}
	
	public static function destroy ( ) {
		session_destroy();
	}
	
	public static function getType(){
		return self::$type;
	}
	
	/**
	 * Sobreescrever com a lógica de autenticação
	 * 
	 * @return int {VISITOR, USER, ADMINISTRATOR}
	 */
	public abstract function authenticate ( $type );
	
}
