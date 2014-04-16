<?php

$p = new PersonPaginator( $pageContent["Records"] );

try {
	$pageContent["Records"] = $p->fillRow();
} catch ( Exception $e ) {
	$pageContent["Error"] = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23" />
	
	<title><?php echo $pageContent["Title"]; ?></title>
	
	<?php
	getCss( "main" );
	getJs( "jquery" );
	getJs( "ajax" );
	getJs( "person" ); // ../js/person.js
	?>
	
</head>

<body>
	
	<h2><?php echo $pageContent["Title"]; ?></h2>
	<h4><?php echo $pageContent["Subtitle"]; ?></h4>
	
	<h4 class='error'><?php echo $pageContent["Error"]; ?></h4>
	
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Last Name</th>
				<th>Time Check</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			
			foreach ( $pageContent["Records"] as $reg ) {
				echo $reg;
			}
			
			?>
			
		</tbody>
		<tfoot>
			<tr>
				<td colspan='5'>
					<?php
					echo $p->getFirstPageAutoload();
					echo $p->getPageloadButtons();
					echo $p->getPageloadArray();
					?>
					<button onclick='javascript:more()'>
						more
					</button>
				</td>
			</tr>
			
		</tfoot>
	</table>
	
	
</body>

</html>

