<?php

abstract class Paginator {
	
	/**
	 * Gera uma linha sem recheio;
	 */
	abstract function getRawRow();
	
	/**
	 * Recheia uma linha
	 */
	abstract function fillRow();
	
	const AUTOCALL = "
	<script>
		$(document).ready( function autoLoadCall(){ 
			hideUnloaded();
			more();
		} );
	</script>
	";
	const PAGE_BUTTON = "
	<button onclick='javascript:loadPage(:Ppage);'>
		:Ppage
	</button>
	";
	const JAVASCRIPT_CALL = "
			load( :Pid );"
	;
	
	const ITENS_POR_PAGINA = Config::ITEMS_PER_PAGE;
	
	protected $jsPageArray = "";
	protected $pageloadButtons = array();
	
	public function getPageloadButtons(){
		return implode( $this->pageloadButtons );
	}
	public function getFirstPageAutoload(){
		return self::AUTOCALL;
	}
	public function getPageloadArray(){
		return "<script>" . $this->jsPageArray . "</script>";
	}
	
}
