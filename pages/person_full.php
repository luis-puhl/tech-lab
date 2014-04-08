<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23" />
	
	<title><?php echo $pageContent["Title"]; ?></title>
	
	<?php
	getCss( "main" );
	?>
	
</head>

<body>
	
	<h2><?php echo $pageContent["Title"]; ?></h2>
	<h4><?php echo $pageContent["Subtitle"]; ?></h4>
	
	<h4 class='error'><?php echo $pageContent["Error"]; ?></h4>
	
	<article id='record'>
		<header>
			<label for='record[id]'>ID: </label>
			<input type='text' id='record[id]' readonly='readonly' size='5' 
			value='<?php echo $pageContent["Record"]->id; ?>' />
		</header>
		
		<br />
		<label for='record[name]'>Name: </label>
		<input type='text' id='record[name]'
		value='<?php echo $pageContent["Record"]->name; ?>' />
		
		<br />
		<label for='record[name_last]'>Last Name: </label>
		<input type='text' id='record[name_last]' 
		value='<?php echo $pageContent["Record"]->name_last; ?>' />
		
	</article>
	
	
</body>

</html>

