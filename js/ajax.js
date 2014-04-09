
function loadResourceCompact( URL, id, DOMTarget, extraData ){
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
			
		},
		error: function loadResourceCompactError ( xhr, status ) {
			
			var msg = "Sorry, there was a problem!";
			traget = $( DOMTarget );
			traget.siblings().remove();
			traget.after( msg );
			
		},
		// code to run regardless of success or failure
		complete: function loadResourceCompactComplete ( xhr, status ) {
			
			$( "img#loaderGIF_"+id ).hide();
			
		}
	};
	
	
	for (var i in extraData) {
		ajaxRequestMaker.data[i] = extraData[i];
	}
	
	$.ajax( ajaxRequestMaker );
	
}


