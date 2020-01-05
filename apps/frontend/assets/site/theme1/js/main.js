 jQuery(document).ready(function($){
    
    // jQuery sticky Menu
    
	$(".mainmenu-area").sticky({topSpacing:0});
    
    
    $('.product-carousel').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:5,
            }
        }
    });  
    
    $('.related-products-carousel').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:2,
            },
            1200:{
                items:3,
            }
        }
    });  
    
    $('.brand-list').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:4,
            }
        }
    });    
    
    
    // Bootstrap Mobile Menu fix
    $(".navbar-nav li a").click(function(){
        $(".navbar-collapse").removeClass('in');
    });    
    
    // jQuery Scroll effect
    $('.navbar-nav li a, .scroll-to-up').bind('click', function(event) {
        var $anchor = $(this);
        var headerH = $('.header-area').outerHeight();
        $('html, body').stop().animate({
            scrollTop : $($anchor.attr('href')).offset().top - headerH + "px"
        }, 1200, 'easeInOutExpo');

        event.preventDefault();
    });    
    
    // Bootstrap ScrollPSY
    $('body').scrollspy({ 
        target: '.navbar-collapse',
        offset: 95
    })  
  
});
$(function(){
var clicked = '';
	$('button[type="submit"]').click(function(){
		clicked = $(this).attr('id');
		if(document.getElementById(""+clicked+"")==null){
		return false;
	}
		callmeonajax(clicked)
	});
	
	$('.add-to-cart-link').click(function(){
		data = $(this).attr('data');
		var form = document.getElementById("addCart_"+data);
        dataString =  $(form).serialize();
		$.ajax({
		type: "POST",
		url: filePath+"shopping/add",
		data: dataString,
		dataType: "json",
		timeout: 30000,
		error: function (xhr, err) {
		showErrorAjax(xhr, err);
		},
		success: function(data) {
		
		   	if(data.status == '1'){
		      $(".cart-amount").html(cur_code+' '+data.amount);
			  $(".product-count").html(data.count);
			  
			}
		   if(data.status == '0' ){
			estr = '';
			if( Trimnew(data.errorCount) !='' ){
			   err_i=0;
				for (var key in data.errorCount) {
                    estr = estr +" "+data.errorCount[''+key+'']+" | ";
					err_i =err_i+1;
                   }
				   alert(estr);
			}
			}
		}
		});
		 
    });
	
	$('.product-remove a.remove').click(function(){
		datarow = $(this).attr('data');
		$.ajax({
		type: "POST",
		url: filePath+"shopping/remove",
		data: {rowid:datarow},
		dataType: "json",
		timeout: 30000,
		error: function (xhr, err) {
		showErrorAjax(xhr, err);
		},
		success: function(data) {
		
		   	if(data.status == '1'){
		      $('.remove_product_'+datarow).remove();
			    $(".cart-amount").html(cur_code+' '+data.amount);
			    $(".product-count").html(data.count);
			}
		   if(data.status == '0' ){
			estr = '';
			if( Trimnew(data.errorCount) !='' ){
			   err_i=0;
				for (var key in data.errorCount) {
                    estr = estr +" "+data.errorCount[''+key+'']+" | ";
					err_i =err_i+1;
                   }
				   alert(estr);
			}
			}
		}
		});
		 
    });
	
	jQuery("#checkout").submit(function(){
	
    
		$.ajax({
		type: "POST",
		url: filePath+"shopping/save_order",
		dataType: "json",
		timeout: 30000,
		error: function (xhr, err) {
		    showErrorAjax(xhr, err);
		},
		success: function(data) {
		
		   	if(data.status == '1'){
			  window.location = filePath+"shopping/thankyou";
			}
			if(data.status == '2'){
			  alert(data.message);
			  $( "ul li a.cd-signin").trigger( "click" ); 	
			}
			if(data.status == '3'){
			  alert(data.message);	
			}
		   if(data.status == '0' ){
			estr = '';
			if( Trimnew(data.errorCount) !='' ){
			   err_i=0;
				for (var key in data.errorCount) {
					if(err_i>0){
					 estr = estr +"<br> <div style=\"height:25px;\">&nbsp;</div>";	
					}
                    estr = estr +" <span class=\"verify\"><b>"+data.errorCount[''+key+'']+"</b></span>";
					err_i =err_i+1;
                   }
			}
			}
			
		
		}
		});
	return false;
 });
	
});

function callmeonajax(clicked){
	$(document).ajaxStart(function(){
	$( "#"+clicked+" .loader" ).removeClass( "hide" );
	document.getElementById(""+clicked+"").disabled = true;
	$(this).unbind("ajaxStart");
	});
	$( document ).ajaxStop(function() {
		
		$( "#"+clicked+" .loader" ).addClass( "hide" );
	     document.getElementById(""+clicked+"").disabled = false;
		$(this).unbind("ajaxStop");
	});
	
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


