
function loadResourceCompact
	( URL, id, DOMTarget, extraData, errorMessage, sucessCallback ){
	
	console.log("requesting " + URL + ":" + id );
	
	var ajaxRequestMaker = {
		url: URL,
		data: {
			"id": id,
			"get": "compact"
		},
		type: "GET",
		// the type of data we expect back
		dataType : "html",
		success: function loadResourceCompactSucess ( html ) {
			
			traget = $( DOMTarget );
			traget.siblings().remove();
			traget.after( html );
			
			sucessCallback();
			
		},
		error: function loadResourceCompactError ( xhr, status ) {
			
			var msg = "<p class='smallError'>" + errorMessage + "</p>";
			traget = $( DOMTarget );
			traget.siblings().remove();
			traget.after( msg );
			
		},
		// code to run regardless of success or failure
		complete: function loadResourceCompactComplete ( xhr, status ) {
			
		}
	};
	
	
	for (var i in extraData) {
		ajaxRequestMaker.data[i] = extraData[i];
	}
	
	$.ajax( ajaxRequestMaker );
	
}



function formAjax ( action, method, name, dataJson, suceesCallback ){
	
	console.log("sending form " + action + ":" + name );
	
	var ajaxRequestMaker = {
		url: action,
		data: dataJson,
		type: method,
		// the type of data we expect back
		dataType : "text",
		success: function formAjaxSucess ( html ) {
			suceesCallback();
		},
		error: function formAjaxError ( xhr, status ) {
			
		},
		// code to run regardless of success or failure
		complete: function formAjaxComplete ( xhr, status ) {
			
		}
	};
	
	$.ajax( ajaxRequestMaker );
	
}


