/**
 * 
 * 
 */

function loadForeachWay( element, index, array ){
	load( element );
}

function load( id, url ){
	var DOMTarget = "td#reg_" + id;
	var extraData = [];
	var errorMessage = "Sorry, there was a problem!";
	
	$( "tr#reg_" + id ).show();
	
	var callback = function loadCallback(){
		return success( id, url );
	}
	
	loadResourceCompact( url, id, DOMTarget, extraData, 
		errorMessage, callback );
}

/**
 * Funções para interceptar os formulários das páginas carregadas por AJAX
 */
function success( id, url ) {
	
	var callback = function successCallback(){
		return formIntercepter( id, url );
	}
	
	// intercepta o envio do formulário
	$( "form#" + id ).submit( callback );
	
}
function formIntercepter( id, url ) {
	/**
	 * Ideia por http://gilbert.pellegrom.me/html-forms-to-ajax-forms-the-easy-way/
	 */
	// executa a solicitação igual ao form por AJAX
	var form =  $("form#" + id);
	var data = form.serialize();
	var method = form.attr("method");
	var action = form.attr("action");
	var name = form.attr("id");
	
	var callback = function formIntercepterCallback(){
		return load( id, url );
	}
	
	formAjax ( action, method, name, data, callback );
	
	// Important. Stop the normal POST
	return false;
}



function hideUnloaded(){
	$( "tr.unload" ).hide();
}

var page = new Array();
lastPageLoad = 0;
function more(){
	page[lastPageLoad].forEach( loadForeachWay );
	lastPageLoad++;
}
function loadPage( i ){
	page[ i ].forEach( loadForeachWay );
}
