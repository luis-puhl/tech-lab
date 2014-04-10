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
	getJs( "person" );
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
			
			// cria um modelo do que mostrar
			$html = "
			<tr>
				<td id='reg_:Pid'>
					<a href=':Purl?id=:Pid'>
						:Pid
					</a>
					<button onclick='load( :Pid )'>Reload</button>
				</td>
				<td class='placeHolder'>
					:Pname
					<script>
						$(document).ready( function(){ return load( :Pid ); } );
					</script>
				</td>
			</tr>
			";
			$html = str_replace( ":Purl", getPageURL( 'person' ), $html );
			
			// para cada registro, substitui os dados no modelo e mostra;
			foreach ( $pageContent["Records"] as $reg ) {
				$finalHtml = str_replace( ":Pid", $reg->id, $html );
				$finalHtml = str_replace( ":Pname", $reg->name, $finalHtml );
				echo $finalHtml;
			}
			
			// gera um erro, propositalmete para demostrar estabilidade
			$finalHtml = str_replace( ":Pid", "0", $html );
			$finalHtml = str_replace( ":Pname", "n", $finalHtml );
			echo $finalHtml;
			
			?>
			
		</tbody>
	</table>
	
	
</body>

</html>

