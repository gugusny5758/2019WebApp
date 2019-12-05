window.onload = function() {
    $("b_xml").onclick=function(){
		new Ajax.Request('books.php', {
			method: "get",
			parameters: {category: getCheckedRadio($$("input"))},
			onSuccess: showBooks_XML,
			onFailure: ajaxFailed,
			onException: ajaxFailed
		});
    }
    $("b_json").onclick=function(){
		new Ajax.Request('books_json.php', {
			method: "get",
			parameters: {category: getCheckedRadio($$("#category input"))},
			onSuccess: showBooks_JSON,
			onFailure: ajaxFailed,
			onException: ajaxFailed
		});
    }
};

function getCheckedRadio(radio_button){
	for (var i = 0; i < radio_button.length; i++) {
		if(radio_button[i].checked){
			return radio_button[i].value;
		}
	}
	return undefined;
}

function showBooks_XML(ajax) {
	var bookdata = (ajax.responseXML).getElementsByTagName('book');
	var output = "<ul>";
	for(var i = 0 ; i < bookdata.length ; i++){
		output += "<li>" + bookdata[i].getElementsByTagName('title')[0].firstChild.nodeValue 
				+ ", by " + bookdata[i].getElementsByTagName('author')[0].firstChild.nodeValue
				+ " (" + bookdata[i].getElementsByTagName('year')[0].firstChild.nodeValue + ")</li>";
	}
	output += "</ul>";
	$('books').innerHTML = output;
}

function showBooks_JSON(ajax) {
	var bookdata = JSON.parse(ajax.responseText).books;
	var output = "<ul>";
	for(var i = 0 ; i < bookdata.length ; i++){
		output += "<li>" + bookdata[i].title 
				+ ", by " + bookdata[i].author
				+ " (" + bookdata[i].year + ")</li>";
	}
	output += "</ul>";
	$('books').innerHTML = output;
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
