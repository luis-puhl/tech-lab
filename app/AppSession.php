<?php

class AppSession extends Session {
	
	function authenticate (){
		return self::USER;
	}
	
}
