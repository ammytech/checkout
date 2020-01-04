<?php include 'header.php';?>
<link href="<?php echo ADMIN_THEME1?>css/pages/signin.css" rel="stylesheet" type="text/css">

<div class="navbar navbar-fixed-top">

<div class="navbar-inner">

<div class="container"><a class="btn btn-navbar" data-toggle="collapse"
	data-target=".nav-collapse"> <span class="icon-bar"></span> <span
	class="icon-bar"></span> <span class="icon-bar"></span> </a> <!--			<a class="brand" href="index.html">-->
<!--				Bootstrap Admin Template				--> <!--			</a>		-->

<div class="nav-collapse">
<ul class="nav pull-right">

	 <li class="" style="min-height:30px;">
	 <!--<a href="<?php echo DOMAIN_PATH;?>register" class="">
	Don't have an account? Register </a>
	 -->
	</li>
	

	<li class=""><!--						<a href="index.html" class="">--> <!--							<i class="icon-chevron-left"></i>-->
	<!--							Back to Homepage--> <!--						</a>--></li>
</ul>

</div>
<!--/.nav-collapse --></div>
<!-- /container --></div>
<!-- /navbar-inner --></div>
<!-- /navbar -->

<div class="formvalidation_error" style="display:none" >
<div class="alert alert-block" >
<button class="close" data-hide="alert" type="button">&times;</button>
<div id="error_div_message"></div>
</div>
</div>
<div class="account-container">

<div class="content clearfix"><?php $attributes = array('id' => 'userLogin', 'name' => 'userLogin','method' => 'post','autocomplete'=>'off');
echo form_open('', $attributes); ?>

<!-- <h1>Member Login</h1>  -->
<div class="row row-centered">
<div class="col-xs-6 col-centered">
<h3> Login </h3>

<p>&nbsp;</p>
</div>
</div>

<div class="login-fields">



<div class="field"><label for="username">Username</label> <input
	type="text" id="username" name="username" value=""
	placeholder="Username" class="login username-field" /></div>
<!-- /field -->

<div class="field"><label for="password">Password:</label> <input
	type="password" id="password" name="password" value=""
	placeholder="Password" class="login password-field" /></div>
<!-- /password --></div>
<!-- /login-fields -->

<div class="login-actions">
<!--<span class="login-checkbox"> <input-->
<!--	id="keep_login" name="keep_login" type="checkbox"-->
<!--	class="field login-checkbox" value="keeplog" tabindex="4" /> <label-->
<!--	class="choice" for="keep_login">Keep me signed in</label> </span>-->
<div class="row row-centered">
<div class="col-xs-6 col-centered">
<button type="submit" id="auth_login"
	class="button btn btn-success btn-large ">Sign In
	<img class="loader hide" width="20px" alt="please wait ..." src="<?php echo ADMIN_THEME1?>img/loader.gif">
	</button>
</div>
</div>
</div>
<!-- .actions -->



</form>

</div>
<!-- /content --></div>
<!-- /account-container -->



<!--<div class="login-extra"><a href="#">Reset Password</a></div>-->
<!-- /login-extra -->


<?php include 'sub_footer.php';?>
<script type="text/javascript">
$(function(){
	$("#userLogin").submit(function(){
		
		var username = $("#username").val();
		var pswrd = $("#password").val();
		
		if(username == ""){ 
			$("#username").focus();
			return false;
		}
	
		if(pswrd == ""){
		    $("#password").focus();
			return false;
		}
		
		
	    dataString = $("#userLogin").serialize();
	    
			$.ajax({
			type: "POST",
			url: filePath+"verifylogin",
			data: dataString,
			dataType: "json",
			timeout: 10000,
			error: function (xhr, err) {
				if(xhr.status == 400){
					data = $.parseJSON(xhr.responseText);
					showLoginError(data);
				} else {
			        showErrorAjax(xhr, err);
				}
			},
			success: function(data) {
			
			   	if (data.status == '1'){
    			   $(".formvalidation_error").hide();
    			   window.top.location = data.url;
				}
			   if (data.status == '0' && data.errors != ''){
				   showLoginError(data);
				}
			
			}
			});
		return false;
	 });
	 function showLoginError(data){
		 
		 $(".formvalidation_error").show();
		   $(".alert-block").show();
		   $("#error_div_message").html("" + data.errors + "");
	 }
	 $('.bodyp').show();
});
</script>


</body>

</html>
