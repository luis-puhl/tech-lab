<?php
if ( file_exists( "../boot.php" ) ){
	include_once( "../boot.php" );
}

// valida o acesso à página
$sessao = new AppSession( Session::VISITOR );

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$pageContent = array(
	"Title" => "Person",
	"Subtitle" => "Nenhum Id especificado",
	"Record" => new Person(),
	"Error" => "",
);

if ( isset( $id ) ){
	$person = $pageContent["Record"];
	
	$person->id = $id;
	try {
		$person->load();
	} catch (PDOException $e){
		$pageContent["Error"] = $e->getMessage();
	}
	
	$fullName = $person->name . " " . $person->name_last;
	
	$pageContent["Subtitle"] = $fullName;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23" />
	<title><?php echo $pageContent["Title"]; ?></title>
</head>

<body>
	
	<h2><?php echo $pageContent["Title"]; ?></h2>
	<h4><?php echo $pageContent["Subtitle"]; ?></h4>
	
	<h4 style='text-color: red;'><?php echo $pageContent["Error"]; ?></h4>
	
	<article id='record'>
		<header>
			<label for='record[id]'>ID: </label>
			<input type='text' value='<?php echo $pageContent["Record"]->id; ?>' 
			id='record[id]' disabled='disabled' size='5' />
		</header>
		
		<br />
		<label for='record[name]'>Name: </label>
		<input type='text' value='<?php echo $pageContent["Record"]->name; ?>'
		 id='record[name]' />
		
		<br />
		<label for='record[name_last]'>Last Name: </label>
		<input type='text' value='<?php echo $pageContent["Record"]->name_last; ?>'
		 id='record[name_last]' />
		
	</article>

	
	
</body>

</html>
