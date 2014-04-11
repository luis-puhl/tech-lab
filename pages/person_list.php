<?php

class PersonPaginator extends Paginator{
	
	private $pageContent;
	function __construct( $pageContent ){
		$this->pageContent = $pageContent;
	}
	
	private $rawRow = "";
	function getRawRow(){
		// cria um modelo do que mostrar
		if ( $this->rawRow != "" ){
			return $this->rawRow;
		}
		
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
			</td>
		</tr>
		";
		$html = str_replace( ":Purl", getPageURL( 'person' ), $html );
		
		$this->rawRow = $html;
		
		return $html;
	}
	
	function fillRow(  ){
		$ret = array();
		
		$linhaReg = array();
		
		$itens = 0;
		$pagina = 0;
		$loadCalls = array();
		foreach ( $this->pageContent as $reg ) {
			$itens++;
			
			$finalHtml = str_replace( ":Pid", $reg->id, $this->getRawRow() );
			$finalHtml = str_replace( ":Pname", $reg->name, $finalHtml );
			
			// define a chamada para carregar por AJAX
			$loadCalls[] = str_replace( ":Pid", $reg->id, self::JAVASCRIPT_CALL );
			
			$loadCalls = $this->contaPaginas( $itens, $loadCalls );
			
			$ret[] = $finalHtml;
			
		}
		
		// faz a ultima pagina
		$itens += self::ITENS_POR_PAGINA - 1;
		$loadCalls = $this->contaPaginas( $itens, $loadCalls );
		
		return $ret;
	}
	
	private function contaPaginas( $numeroRegistros, $loadCalls ){
		
		if ( $numeroRegistros % self::ITENS_POR_PAGINA == 0 ){
			$pagina = (int) $numeroRegistros / self::ITENS_POR_PAGINA - 1;
			
			if ( $pagina == 0 ) {
				// cria um carregador de conteudo para o onload
				
				$loadCallsStr = implode( $loadCalls );
				$this->firstPageAutoload = str_replace( ":PscriptCall", $loadCallsStr, self::AUTOCALL );
				
				$loadCalls = array();
				
			} else {
				
				// cria um botão de carregamento de pagina
				$loadCallsStr = implode( $loadCalls );
				
				$btn = str_replace( ":PscriptCall", $loadCallsStr, self::PAGE_BUTTON );
				$btn = str_replace( ":Ppage", $pagina, $btn );
				$loadCalls = array();
				
				$this->pageloadButtons[] = $btn;
			}
			
			$pagina++;
		}
		
		
		return $loadCalls;
	}
	
}


$p = new PersonPaginator( $pageContent["Records"] );

/*
// para cada registro, substitui os dados no modelo e mostra;
$linhaReg = array();

$itens = 0;
define( "ITENS_POR_PAGINA", 1);
$pagina = 0;
$btnPaginas = array();
$loadCalls = array();
foreach ( $pageContent["Records"] as $reg ) {
	$itens++;
	
	$finalHtml = str_replace( ":Pid", $reg->id, $html );
	$finalHtml = str_replace( ":Pname", $reg->name, $finalHtml );
	
	$linhaReg[] = $finalHtml;
	
	// paginação em AJAX
	$loadCalls[] = str_replace( ":Pid", $reg->id, $scriptCall );
	
	if ( $pagina == 0){
		
		$loadCallsStr = implode( $loadCalls );
		$autoloadPrimeiraPagina = str_replace( ":PscriptCall", $loadCallsStr, $autocall );
		
	}
	
	if ( $itens % ITENS_POR_PAGINA == 0 ){
		if ( $pagina != 0 ) {
			
			$loadCallsStr = implode( $loadCalls );
			
			$btn = str_replace( ":PscriptCall", $loadCallsStr, $btnPage );
			$btn = str_replace( ":Ppage", $pagina, $btn );
			$loadCalls = array();
			
			$btnPaginas[] = $btn;
		}
		
		$itens = 0;
		$pagina++;
	}
	
	
}
*/
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
			
			foreach ($p->fillRow() as $reg) {
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
					?>
				</td>
			</tr>
			
		</tfoot>
	</table>
	
	
</body>

</html>

