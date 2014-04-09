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
			</tr>
		</thead>
		<tbody>
			<?php
			
			$registros = $pageContent["Records"];
			
			$html = "
			<tr>
				<td id='reg_:Pid'>
					:Pid
					<button onclick='load:Pid()'>Reload</button>
				</td>
				<td class='placeHolder'>
					:Pname
					<script>
						function load:Pid(){
							var URL = 'person.php';
							var id = :Pid;
							var DOMTarget = 'td#reg_:Pid';
							var extraData = [];
							loadResourceCompact( URL, id, DOMTarget, extraData );
						}
						
						$(document).ready( load:Pid() );
					</script>
				</td>
			</tr>
			";
			
			foreach ( $registros as $reg ) {
				$finalHtml = str_replace( ":Pid", $reg->id, $html );
				$finalHtml = str_replace( ":Pname", $reg->name, $finalHtml );
				echo $finalHtml;
			}
			
			$finalHtml = str_replace( ":Pid", "0", $html );
			$finalHtml = str_replace( ":Pname", "n", $finalHtml );
			echo $finalHtml;
			
			?>
			
		</tbody>
	</table>
	
	
</body>

</html>

