
function load( id, url ){
	var DOMTarget = "td#reg_" + id;
	var extraData = [];
	var errorMessage = "Sorry, there was a problem!";
	
	var callback = function (){
		return success( id, url );
	}
	
	loadResourceCompact( url, id, DOMTarget, extraData, 
		errorMessage, callback );
}

function success( id, url ) {
	
	var callback = function (){
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
	
	var callback = function (){
		return load( id, url );
	}
	
	formAjax ( action, method, name, data, callback );
	
	// Important. Stop the normal POST
	return false;
}
