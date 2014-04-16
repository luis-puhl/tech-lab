<?php
if ( file_exists( "../boot.php" ) ){
	include_once( "../boot.php" );
}

// valida o acesso à página
$sessao = new AppSession( Session::VISITOR );

if ( Cache::getUpdateTime( "test", "person" ) > 3600 ){
	header( "Cache-Control: private, must-revalidate", true );
	header( "Pragma: private", true );
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$accept = filter_input(INPUT_GET, 'get', FILTER_SANITIZE_STRING);

if ( !isset( $id ) && !isset( $accept ) ){
	$accept = "list";
}

$pageContent = array(
	"Title" => "Person",
	"Subtitle" => "Nenhum Id especificado",
	"Record" => new Person(),
	"Error" => null,
);

if ( isset( $id ) ){
	$person = $pageContent["Record"];
	
	$person->id = $id;
	try {
		$person->load();
	} catch (PDOException $e){
		/**
		 * Se não consegue carregar um registro específico, 
		 * O erro é do cliente (400+ -> 404)
		 */
		$msg = $e->getMessage() . " (id: " . $id . ")";
		$pageContent["Error"] = new ControllerException( $msg, 404, $e );
	}
	
	$fullName = $person->name . " " . $person->name_last;
	
	$pageContent["Subtitle"] = $fullName;
} else {
	$person = $pageContent["Record"];
	
	try {
		$pageContent["Records"] = $person->loadAll();
	} catch (PDOException $e){
		/**
		 * Se não consegue carregar nenhum quando tenta todos
		 * O erro é interno (500+)
		 */
		$msg = $e->getMessage() . " (id: " . $id . ")";
		$pageContent["Error"] = new ControllerException( $msg, 500, $e );
	}
	
	$pageContent["Subtitle"] = "Listagem";
}

switch ( $accept ){
	case "compact":
	case "list":
		include_once( "person_" . $accept . ".php" );
	break;
	default: 
		include_once( "person_full.php" );
}

