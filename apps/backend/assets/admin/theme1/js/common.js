if (window.location.protocol == "https:"){
	var sitePath = "https://"+window.location.host;
	}else{
	var sitePath = "http://"+window.location.host;
	}
   var filePath = sitePath+"/";
  var moveLeft = 40;
  var moveDown = -120;
$(function(){
    $("[data-hide]").on("click", function(){
        $(this).closest("." + $(this).attr("data-hide")).hide();
    });
});
$(function(){
	   var clicked = '';
		$('button[type="submit"]').click(function(){
			clicked = $(this).attr('id');
			callmeonajax(clicked)
		});
		
	});
	
	function callmeonajax(clicked){
		
		$(document).ajaxStart(function(){
		$( "#"+clicked+" .loader" )
	    .removeClass( "hide" );
		document.getElementById(""+clicked+"").disabled = true;
		$(this).unbind("ajaxStart");
		});
		$( document ).ajaxStop(function() {
			
			$( "#"+clicked+" .loader" )
	      .addClass( "hide" );
		  document.getElementById(""+clicked+"").disabled = false;
		$(this).unbind("ajaxStop");
			
		});
	   }
	   
	   function showErrorAjax(jqXHR,exception){
			var msg = '';
			if (jqXHR.status === 0) {
				msg = 'Not connect.\n Verify Network.';
			} else if (jqXHR.status == 400) {
				msg = 'Bad Request. [400]';
			} else if (jqXHR.status == 404) {
				msg = 'Requested page not found. [404]';
			} else if (jqXHR.status == 500) {
				msg = 'Internal Server Error [500].';
			} else if (exception === 'parsererror') {
				msg = 'Requested JSON parse eror';
			} else if (exception === 'timeout') {
				msg = 'Time out';
			} else if (exception === 'abort') {
				msg = 'request aborted';
			} else {
				msg = 'Uncaught Error.\n' + jqXHR.responseText;
			}
			$("div#spinner").fadeOut("fast");
			$("div#spinner2").fadeOut("fast");
			$(".loader").hide();
			alert(msg+", try again");
	   }
	/********  TRIM LEFT FUNCTION ******************/
function lTrim(str)
{
	var whitespace = new String(" \t\n\r");
	var s = new String(str);
	if (whitespace.indexOf(s.charAt(0)) != -1) {
		// We have a string with leading blank(s)...
		var j=0, i = s.length;
		while (j < i && whitespace.indexOf(s.charAt(j)) != -1)
			j++;
		s = s.substring(j, i);
	}
	return s;
}
/****** TRIM RIGHT FUNCTION ****************/
function rTrim(str)
{
	var whitespace = new String(" \t\n\r");
	var s = new String(str);
	if (whitespace.indexOf(s.charAt(s.length-1)) != -1) {
		var i = s.length - 1;       // Get length of string
		while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1)
			i--;
		s = s.substring(0, i+1);
	}
	return s;
}
function Trimnew(str){
	var data = rTrim(lTrim(str));
	return data;
}

function isValidEmailAddress(emailAddress) {
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
}
function displayImg(idname,errorTypett,mes,donefocus){
//alert(idname);
    if(errorTypett == 'no'){
		if(donefocus === false){
	      $("#"+idname+"").focus();
		}
	$("#"+idname+"_verify").css({ "display": "block" });
	$("#"+idname+"_verify").html(mes);
	
	}else{
	$("#"+idname+"_verify").css({ "display": "none" });
	$("#"+idname+"_verify").html('');
	}
	
}


	String.prototype.ucfirst=function(all){
	    if(all){
	       return this.split(' ').map(function(e){return e.ucfirst();}).join(' ');    
	    }else{
	         return this.charAt(0).toUpperCase() + this.slice(1);
	    } 
	}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
} 
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
} 

$(document).ajaxSuccess(function(event, xhr, data) {
	data = xhr.responseText;
	data = JSON.parse(data);
  if(data && data.loggedout=='1'){
          alert('session lost');
		  location.reload(); 
	}
});