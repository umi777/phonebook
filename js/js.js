///////////////////////////////////////////
function ajaxRequest(arg){
	if (arg == "list") {
		listContact(arg) ;
	}
	else {
		delContact(arg) ;
		listContact("list") ;
	}
}

function listContact(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("list_contact").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("list_contact").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "js/ajax_request.php?q="+str, true);
  xhttp.send();
}

function delContact(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("list_footer").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("list_footer").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "js/ajax_request.php?id="+str, true);
  xhttp.send();
}