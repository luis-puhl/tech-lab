<?php

class AppSession extends Session {
	
	public function __construct ( $type = self::VISITOR ){
		self::start( $this, $type );
	}
	
	public function authenticate (){
		return self::USER;
	}
	
}
