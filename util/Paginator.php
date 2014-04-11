<?php

abstract class Paginator {
	
	/**
	 * Gera uma linha sem recheio;
	 */
	abstract function getRawRow();
	
	/**
	 * Co-rotina => generator;
	 * Recheia uma linha
	 */
	abstract function fillRow();
	
	const AUTOCALL = "
	<script>
		$(document).ready( function(){ 
			:PscriptCall
		} );
	</script>
	";
	const PAGE_BUTTON = "
	<button onclick='javascript::PscriptCall'>
		:Ppage
	</button>
	";
	const JAVASCRIPT_CALL = "
			load( :Pid );";
	
	const ITENS_POR_PAGINA = 5;
	
	
	protected $firstPageAutoload = "";
	protected $pageloadButtons = array();
	
	public function getPageloadButtons(){
		return implode( $this->pageloadButtons );
	}
	public function getFirstPageAutoload(){
		return $this->firstPageAutoload;
	}
	
}
