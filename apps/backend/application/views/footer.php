<div class="extra">
  <div class="extra-inner">
    <div class="container">
      <div class="row">
                    <div class="span3">
                        <h4>
                             <?php echo $this->site_name;?></h4>
                        <ul>
                            <li><a href="<?php echo DOMAIN_PATH?>"><?php echo $this->site_name;?></a></li>
                            
                        </ul>
                    </div>
                   
                   
                </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /extra-inner --> 
</div>
<!-- /extra -->
<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2015 <a href="<?php echo DOMAIN_HOST?>"><?php echo $this->site_name?></a>. </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
</div>
<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<?php include 'sub_footer.php';

?>

 <script type="text/javascript">
 var backurl = '<?php echo DOMAIN_PATH?>';

 var docu_title = document.title;

 $(function(){
	    $('.mainnav .dropdown').hover(function() {
	         $(this).toggleClass('open');
	    });
	   
    </script>
    
    


<script>

$(function(){
$('.mainnav .dropdown').hover(function() {
	         $(this).toggleClass('open');
	    });
$('.bodyp').show();
var show_text = 'Show Menu';
var hide_text = 'Hide Menu';
var menu_hide_show_cookie = getCookie('menu-hide-show');
if(menu_hide_show_cookie=='' || menu_hide_show_cookie=='1'){
	$(".subnavbar .subnavbar-inner").show();
	$(".menu-expand span").text(hide_text);
}else{
	$(".subnavbar .subnavbar-inner").hide();
	$(".menu-expand span").text(show_text);
}
$(".menu-expand").click(function () {

    $header = $(this);
    //getting the next element
    $content = $header.next();
    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
    $content.slideToggle(500, function () {
        //execute this after slideToggle is done
        //change text of header based on visibility of content div
        $header.text(function () {
            //change text based on condition
            retval = $content.is(":visible") ? "1" : "0";
            setCookie('menu-hide-show',retval,1);
            return (retval=='0'?show_text:hide_text);
             
        });
    });

});

});
function publish(id,new_status,callurl,htmlid)
{
	 loaderstr = '';
	 if(htmlid != ''){
	   $( "#"+htmlid+" .loader" ).removeClass( "hide" );
	    adminpath = '<?php echo ADMIN_THEME1?>';
	    loaderstr = '<img class="loader hide" width="20px" alt="please wait ..." src="'+adminpath+'img/loader.gif">';
	 }
		$.ajax({
			'type' : 'post',
			'url' : filePath+callurl,
			'data' : { 'id' : id ,'action' : 'publish' , 'new_status' :  new_status},
			'timeout': 20000,
			'beforeSend' : function()
			{},
			'error': function (xhr, err) {
 		 		showErrorAjax(xhr, err);
 			},
			'success' : function(data)
			{
				$( "#"+htmlid+" .loader" ).addClass( "hide" );
				data = JSON.parse(data);
				if(data && data['success'] == 1)
				{
				  if(new_status == 1){
					str = '<a title="click to unpublish" id="a_tag_'+id+'" href="javascript:publish('+id+',0,\''+callurl+'\',\''+htmlid+'\');">'+
								'unpublish'+loaderstr+
				  		  '</a>'; 
				  		
					 
				  }
		  		  else 
		  		  {
		  			str = '<a title="click to publish" id="a_tag_'+id+'" href="javascript:publish('+id+',1,\''+callurl+'\',\''+htmlid+'\');">'+
		  						'publish'+loaderstr+
		  		  		  '</a>';
		  			
		  			
		  		  }
		  		  $('#a_tag_'+id).replaceWith(str);
			   }
			}
		});
	
}
</script>


    <?php if (!isset($footer_html)) {
    ?>
</body>
</html>
<?php 
}?>
