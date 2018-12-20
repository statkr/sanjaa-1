<!-- Google analytics code
================================================== -->
 <?php echo $google_analytics; ?>

<!-- Footer
================================================== -->
<div id="footer">

	<!-- Footer Top Section -->
	<div class="footer-top-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">

					<!-- Footer Rows Container -->
					<div class="footer-rows-container">

						<!-- Left Side -->
						<div class="footer-rows-left">
							<div class="footer-row">
								<div class="footer-row-inner footer-logo">
                  <img src="assets/logo/<?php echo 'logo.png'; ?>" data-sticky-logo="assets/logo/logo.png" alt="">
								</div>
							</div>
						</div>

						<!-- Right Side -->
						<div class="footer-rows-right">

							<!-- Social Icons -->
							<div class="footer-row">
								<div class="footer-row-inner">
									<ul class="footer-social-links">
										<li>
											<a href="<?php echo $facebook; ?>" title="Facebook" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-facebook-f"></i>
											</a>
										</li>
										<li>
											<a href="<?php echo $twitter; ?>" title="Twitter" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-twitter"></i>
											</a>
										</li>
										<li>
											<a href="<?php echo $google; ?>" title="Google Plus" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-google-plus-g"></i>
											</a>
										</li>
										<li>
											<a href="<?php echo $instagram; ?>" title="Instagram" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-instagram"></i>
											</a>
										</li>
                    <li>
											<a href="<?php echo $linkedin; ?>" title="LinkedIn" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-linkedin-in"></i>
											</a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
							</div>

						</div>
					</div>
					<!-- Footer Rows Container / End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Top Section / End -->

	<!-- Footer Middle Section -->
	<div class="footer-middle-section">
		<div class="container">
			<div class="row">

        <!-- About us -->
				<div class="col-xl-4 col-lg-4 col-md-12">
					<h3><i class="icon-feather-mail"></i><?php echo $lang['about']; ?> <?php echo $lang['us']; ?></h3>
					<p><?php echo $footer_about; ?></p>
				</div>

        <!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Helpful Links</h3>
						<ul>
							<li><a href="contact.php"><span><?php echo $lang['contact']; ?> <?php echo $lang['us']; ?></span></a></li>
							<li><a href="faq.php"><span><?php echo $lang['faq']; ?></span></a></li>
							<li><a href="login.php"><span><?php echo $lang['login']; ?></span></a></li>
              <li><a href="register.php"><span><?php echo $lang['register']; ?></span></a></li>
						</ul>
					</div>
				</div>

        <!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>For Clients</h3>
						<ul>
							<li><a href="services.php"><span>Browse Services</span></a></li>
							<li><a href="Client/addjob.php"><span> <?php echo $lang['post']; ?> <?php echo $lang['a']; ?> <?php echo $lang['job']; ?>, <?php echo $lang['it\'s']; ?> <?php echo $lang['free']; ?> !</span></a></li>
							<li><a href="how.php"><?php echo $lang['how']; ?> <span><?php echo $lang['it']; ?> <?php echo $lang['works']; ?></span></a></li>
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>For Freelancers</h3>
						<ul>
							<li><a href="jobs.php"><span>Browse Projects</span></a></li>
              <li><a href="how.php"><span><?php echo $lang['how']; ?> <?php echo $lang['it']; ?> <?php echo $lang['works']; ?></span></a></li>
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3><?php echo $lang['contact']; ?> <?php echo $lang['us']; ?></h3>
						<ul>
							<li><a><span><?php echo $contact_location; ?></span></a></li>
							<li><a><span><?php echo $contact_phone; ?></span></a></li>
              <li><a href="mailto:<?php echo $contact_email; ?>"><span><?php echo $contact_email; ?></span></a></li>
						</ul>
					</div>
				</div>


			</div>
		</div>
	</div>
	<!-- Footer Middle Section / End -->

	<!-- Footer Copyrights -->
	<div class="footer-bottom-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<strong>Sanjaa</strong>. <?php auto_copyright('','All Rights Reserved'); ?>.
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Copyrights / End -->

</div>
<!-- Footer / End -->


</div>
<!-- Wrapper / End -->


<!-- Sign In Popup
================================================== -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#login">Log In</a></li>
			<li><a href="#register">Register</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Login -->
			<div class="popup-tab-content" id="login">

      <!-- Error Text -->
        <div class="notification error closeable" id="login_error" style="display:none ;">
        	<p>Error while login, Check all Fields</p>
        	<a class="close"></a>
        </div>

          <!-- Success Text -->
        <div class="notification success closeable" id="login_success" style="display:none ;">
  				<p>You did it, now relax and enjoy it</p>
  				<a class="close"></a>
			  </div>

				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>We're glad to see you again!</h3>
					<span>Don't have an account? <a href="#" class="register-tab">Sign Up!</a></span>
				</div>

        <a href="login.php" class="button button-sliding-icon ripple-effect" style="width: 331.25px;">Login Now<i class="icon-material-outline-arrow-right-alt"></i></a>

  

				<!-- Form -->
			<!--	<form method="post">
				    
          <div class="account-type">
            <div>
              <input type="radio" name="user_type" value="off" id="freelancer-radio" class="account-type-radio" checked/>
              <label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Freelancer</label>
            </div>

            <div>
              <input type="radio" name="user_type" value="on" id="employer-radio" class="account-type-radio"/>
              <label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Employer</label>
            </div>
          </div>

					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input id="email" type="email" class="input-text with-border" name="email" id="emailaddress" placeholder="Email Address" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-lock"></i>
            <input id="password" type="text" class="input-text with-border" name="password" placeholder="*****" required/>
          </div>
          <div class="checkbox">
				     <input id="remember" checked="" type="checkbox" name="remember">
				   
				    <label for="remember"><span class="checkbox-icon"></span> Remember</label>
			   </div>
					<a href="forgot.php" class="forgot-password">Forgot Password?</a>

  <input id="token" type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
				</form>

				<button id="login_btn" onclick="loginAjax()" class="button full-width button-sliding-icon ripple-effect" type="submit">Log In <i class="icon-material-outline-arrow-right-alt"></i></button>
			--></div>

			<!-- Register -->
			<div class="popup-tab-content" id="register">

				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Let's create your account!</h3>
				</div>
        <a href="register.php" class="button button-sliding-icon ripple-effect" style="width: 331.25px;">Register Now<i class="icon-material-outline-arrow-right-alt"></i></a>

			</div>

		</div>
	</div>
</div>
<!-- Sign In Popup / End -->

<form id="freelancer_link" action="<?php echo $site_base_url; ?>/Freelancer/" method="post">

</form>

<form id="client_link" action="<?php echo $site_base_url; ?>/Client/" method="post">

</form>

<!-- Scripts
================================================== -->
<script src="assets/front_assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/front_assets/js/jquery-migrate-3.0.0.min.js"></script>
<script src="assets/front_assets/js/mmenu.min.js"></script>
<script src="assets/front_assets/js/tippy.all.min.js"></script>
<script src="assets/front_assets/js/simplebar.min.js"></script>
<script src="assets/front_assets/js/bootstrap-slider.min.js"></script>
<script src="assets/front_assets/js/bootstrap-select.min.js"></script>
<script src="assets/front_assets/js/snackbar.js"></script>
<script src="assets/front_assets/js/clipboard.min.js"></script>
<script src="assets/front_assets/js/counterup.min.js"></script>
<script src="assets/front_assets/js/magnific-popup.min.js"></script>
<script src="assets/front_assets/js/slick.min.js"></script>
<script src="assets/front_assets/js/custom.js"></script>

<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
<script>
// Snackbar for user status switcher
$('#snackbar-user-status label').click(function() {
	Snackbar.show({
		text: 'Your hunter has been changed',
		pos: 'bottom-center',
		showAction: false,
		actionText: "Dismiss",
		duration: 3000,
		textColor: '#fff',
		backgroundColor: '#383838'
	});
});
</script>


<script>
  // login ajax function
  /*
  function loginAjax(){
    var email = $('#email').val();
    var password = $('#password').val() ;
    var token = $('#token').val() ;
    var remember = $('#remember').val() ;
    if ($('#employer-radio').is(':checked')) {
      var user_type = $('#employer-radio').val() ;
    }else{
      var user_type = $('#freelancer-radio').val() ;
    }
    $.ajax({
      type: "POST",
      url: "<?php echo $site_base_url; ?>/login_ajax.php",
      data:{
        email:email,
        password:password,
        token:token,
        remember:remember,
        user_type:user_type
      },
      success: function(result){
        if (result == "client") {
          $("#login_success").show() ;
          $("#login_error").hide() ;
          setTimeout(function(){
            $("#client_link").submit() ;
          }, 3000) ;
        }else if (result == "freelancer") {
          $("#login_success").show() ;
          $("#login_error").hide() ;
          setTimeout(function(){
            $("#freelancer_link").submit() ;
          }, 3000) ;
        }else {
            alert(result);
          $("#login_error").show() ;
          $("#login_success").hide() ;
        }
      }

    });
  }

*/

  /*Register ajax function
  function registerAjax(){
    alert("herer") ;
    var emailaddress-register = $('#emailaddress-register').val();
    var password-register = $('#password-register').val() ;
    var password-repeat-register = $('#password-repeat-register').val() ;
    var token_register = $('#token_register').val() ;
    var name-register = $('#name-register').val() ;
    var username-register = $('#username-register').val() ;
    if ($('#employer-radio-register').is(':checked')) {
      var user_type_register = $('#employer-radio-register').val() ;
    }else{
      var user_type_register = $('#freelancer-radio-register').val() ;
    }
    alert("here2");
    $.ajax({
      type: "POST",
      url: "<?php echo $site_base_url; ?>/register_ajax.php",
      data:{
        email:emailaddress-register,
        password:password-register,
        confirmPassword:password-repeat-register,
        name:name-register,
        username:username-register,
        token:token,
        user_type:user_type_register
      },
      success: function(result){
        if (result == "client_register_success") {
          $("#client_link").submit() ;
        }else if (result == "freelancer_register_success") {
          $("#freelancer_link").submit() ;
        }else if (result == "register_error") {
          alert("register_error");
        }
      }

    });
  }*/



  //this function is called at form submit for side job search
  function searcher(){

    $(".keyword-text").each(function(index){
      if ($("#keywords").val().length < 1) {
        $("#keywords").val($(this).text());
      }else {
        $("#keywords").val($("#keywords").val() + "," + $(this).text());
      }
    });

    $(".skill_tag + label").each(function(index){
      var inpt = $(this).attr("for") ;
      if ($("#"+inpt).is(':checked')) {
        if ($("#skill_list").val().length < 1) {
          $("#skill_list").val($(this).text()) ;
        }else {
          $("#skill_list").val($("#skill_list").val() + "," + $(this).text());
        }
      }
    });

    $("#search-form").submit() ;
  }


  //this function is called at form submit for side job search
  function freelancer_searcher(){

    $(".keyword-text").each(function(index){
      if ($("#keywords").val().length < 1) {
        $("#keywords").val($(this).text());
      }else {
        $("#keywords").val($("#keywords").val() + "," + $(this).text());
      }
    });

    $(".skill_tag + label").each(function(index){
      var inpt = $(this).attr("for") ;
      if ($("#"+inpt).is(':checked')) {
        if ($("#skill_list").val().length < 1) {
          $("#skill_list").val($(this).text()) ;
        }else {
          $("#skill_list").val($("#skill_list").val() + "," + $(this).text());
        }
      }
    });



    $("#search-form").submit() ;
  }


</script>

<!-- Google API -->
<!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g&amp;libraries=places&amp;callback=initAutocomplete"></script -->
