<?php

if ( file_exists( "../boot.php" ) ){
	include_once( "../boot.php" );
}

echo("\n<br>");
$s = new AppSession();
var_dump( $s );
var_dump( $s->getType() );
echo("\n<br>");

echo("\n<br>");
$s = new AppSession( Session::VISITOR );
var_dump( $s );
var_dump( $s->getType() );
echo("\n<br>");

echo("\n<br>");
$s = new AppSession( Session::USER );
var_dump( $s );
var_dump( $s->getType() );
echo("\n<br>");

echo("\n<br>");
$s = new AppSession( Session::ADMINISTRATOR );
var_dump( $s );
var_dump( $s->getType() );
echo("\n<br>");

