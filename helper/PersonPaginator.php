<?php

class PersonPaginator extends Paginator {
	
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
		<tr class='unload' id='reg_:Pid'>
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
	
	/**
	 * Processa o conjunto de dados para formar o HTML e as chamadas AJAX;
	 */
	function fillRow(  ){
		// vetor retorno
		$ret = array();
		
		// cria e armazena o padrão de linha vazia
		$rawRow = $this->getRawRow();
		
		/* carrega os dados de cada registro em uma linha vazia
		 * cria as chamadas AJAX e 
		 */
		// conta os itens para agrupar por pagina
		$numeroRegistros = 0;
		// agrupamento de chamadas AJAX para uma página
		$loadCalls = array();
		$ids = array();
		foreach ( $this->pageContent as $reg ) {
			$numeroRegistros++;
			
			$idsStr = "";
			
			$finalHtml = str_replace( ":Pid", $reg->id, $rawRow);
			$finalHtml = str_replace( ":Pname", $reg->name, $finalHtml );
			
			// agrupa o HTML no vetor retorno
			$ret[] = $finalHtml;
			
			// define a chamada para carregar por AJAX
			$loadCalls[] = str_replace( ":Pid", $reg->id, self::JAVASCRIPT_CALL );
			$ids[] = $reg->id;
			// despacha o grupo de chamadas AJAX
			// se preencher uma pagina, limpa o vetor
			/* ---------------------------------------------------------------------------------------------------- */
			/**
			 * Executa toda logica de agrupamento de paginas e posicionamento AJAX
			 */
			if ( $numeroRegistros % self::ITENS_POR_PAGINA == 0 ){
				$pagina = (int) ( $numeroRegistros / self::ITENS_POR_PAGINA -1);
				
				$idsStr = implode( ", ",  $ids );
				$ids = array();
				$idsStr = "page[" . $pagina . "] = [ " . $idsStr . " ];";
				$this->jsPageArray .= $idsStr;
				
				// cria um botão de carregamento de pagina
				$btn = str_replace( ":Ppage", $pagina, self::PAGE_BUTTON );
				
				$this->pageloadButtons[] = $btn;
				
				$loadCalls = array();
				$pagina++;
			}
			/* ---------------------------------------------------------------------------------------------------- */
		}
		
		// faz a ultima pagina
		if ( $numeroRegistros % self::ITENS_POR_PAGINA != 0 ){
			$pagina = (int) ( $numeroRegistros / self::ITENS_POR_PAGINA );
			
			$idsStr = implode( ", ",  $ids );
			$ids = array();
			$idsStr = "page[" . $pagina . "] = [ " . $idsStr . " ];";
			$this->jsPageArray .= $idsStr;
			
			// cria um botão de carregamento de pagina
			$btn = str_replace( ":Ppage", $pagina, self::PAGE_BUTTON );
			
			$this->pageloadButtons[] = $btn;
			
		}
		
		return $ret;
	}
	
	function getJs(){
		
	}
	
}
