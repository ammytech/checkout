 
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2020 eElectronics. All Rights Reserved. Coded with <i class="fa fa-heart"></i> by <a href="http://wpexpand.com" target="_blank">WP Expand</a></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->
   
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="<?php echo FRONT_THEME1?>js/owl.carousel.min.js"></script>
    <script src="<?php echo FRONT_THEME1?>js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="<?php echo FRONT_THEME1?>js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="<?php echo FRONT_THEME1?>js/main.js"></script>
	
		<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
		<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
			<ul class="cd-switcher">
				<li><a href="#0">Sign in</a></li>
				<li><a href="#0">New account</a></li>
			</ul>

			<div id="cd-login"> <!-- log in form -->
				<form class="cd-form" id="userLogin" name="userLogin">
					<p class="fieldset">
						<label class="image-replace cd-email" for="signin-username">E-mail or Phone</label>
						<input class="full-width has-padding has-border" id="signin-username" name="signin-username" type="text" placeholder="E-mail or Phone">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Password</label>
						<input class="full-width has-padding has-border" id="signin-password" name="signin-password" type="text"  placeholder="Password">
						<a href="#0" class="hide-password">Hide</a>
						<span class="cd-error-message">Error message here!</span>
					</p>

			       <p class="fieldset alert alert-danger login-error form-class-error" role="alert">
			 
			               
					</p>
					<p class="fieldset">
						
						<button type="submit" id="login-form" class="full-width">Login
									<img class="loader hide" width="20px" src="<?php echo FRONT_THEME1?>img/loader.gif" alt="please wait ...">
						</button>
					</p>
				</form>
				
				<p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>
				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-login -->

			<div id="cd-signup"> <!-- sign up form -->
				<form name="userRegister" id="userRegister" class="cd-form">
					<p class="fieldset">
						<label class="image-replace cd-username" for="signup-username">Username</label>
						<input class="full-width has-padding has-border" id="signup-username" name="signup-username" type="text" placeholder="Username">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-email" for="signup-email">E-mail</label>
						<input class="full-width has-padding has-border" id="signup-email" name="signup-email"  type="email" placeholder="E-mail">
						<span class="cd-error-message">Enter Valid Email!</span>
					</p>
 
                    <p class="fieldset">
						<label class="image-replace cd-mobile" for="signup-mobile">Mobile</label>
						<input class="full-width has-padding has-border" id="signup-mobile" name="signup-mobile"  type="text" placeholder="Mobile">
						<span class="cd-error-message">Error message here!</span>
					</p>
					
					<p class="fieldset">
						<label class="image-replace cd-password" for="signup-password">Password</label>
						<input class="full-width has-padding has-border" id="signup-password" name="signup-password"  type="text"  placeholder="Password">
						<a href="#0" class="hide-password">Hide</a>
						<span class="cd-error-message">Error message here!</span>
					</p>
                   <p class="fieldset">
						<label class="image-replace cd-address" for="signup-addess">Address</label>
						<input class="full-width has-padding has-border" id="signup-address" name="signup-address""  type="text" placeholder="Address">
						<span class="cd-error-message">Error message here!</span>
					</p>
					<p class="fieldset">
						<input type="checkbox" id="accept-terms" name="accept-terms" >
						<label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
					</p>
                    <p class="fieldset alert alert-danger registeration-error form-class-error" role="alert">
			 
			               
					</p>			  
					<p class="fieldset">
						<button type="submit" class="full-width has-padding" id="register-btn">Register
									<img class="loader hide" width="20px" src="<?php echo FRONT_THEME1?>img/loader.gif" alt="please wait ...">
									
						</button>
					</p>
				</form>

				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-signup -->

			<div id="cd-reset-password"> <!-- reset password form -->
				<p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

				<form class="cd-form">
					<p class="fieldset">
						<label class="image-replace cd-email" for="reset-email">E-mail</label>
						<input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Reset password">
					</p>
				</form>

				<p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
			</div> <!-- cd-reset-password -->
			<a href="#0" class="cd-close-form">Close</a>
		</div> <!-- cd-user-modal-container -->
	</div> <!-- cd-user-modal -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?php echo FRONT_THEME1?>js/login-signup.js"></script>
  </body>
</html>