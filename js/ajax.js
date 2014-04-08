
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
		success: function( html ) {
			
			$( DOMTarget ).siblings().remove();
			$( DOMTarget ).after( html );
			
		},
		error: function( xhr, status ) {
			$( DOMTarget ).after( "Sorry, there was a problem!" );
		},
		// code to run regardless of success or failure
		complete: function( xhr, status ) {
			$( "img#loaderGIF_"+id ).hide();
		}
	};
	
	
	for (var i in extraData) {
		ajaxRequestMaker.data[i] = extraData[i];
	}
	
	$.ajax( ajaxRequestMaker );
	
}


