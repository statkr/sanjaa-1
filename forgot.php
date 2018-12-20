<?php
//Check if frontinit.php exists
if(!file_exists('core/frontinit.php')){
	header('Location: install/');
    exit;
}else{
 require_once 'core/frontinit.php';
}

//Get Site Settings Data
$query = DB::getInstance()->get("settings", "*", ["id" => 1]);
if ($query->count()) {
 foreach($query->results() as $row) {
 	$sid = $row->id;
 	$title = $row->title;
 	$tagline = $row->tagline;
 	$url = $row->url;
 	$description = $row->description;
 	$keywords = $row->keywords;
 	$author = $row->author;
 	$bgimage = $row->bgimage;
 	$smail = $row->mail;
 	$smailpass = $row->mailpass;
 }
}

//Send Email to Reset Password Function
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

	$errorHandler = new ErrorHandler;

	$validator = new Validator($errorHandler);

	$validation = $validator->check($_POST, [
	  'email' => [
	     'required' => true,
	     'maxlength' => 255,
	     'email' => true
	   ]
	]);

	  if (!$validation->fails()) {

		if (Input::get('user_type') === 'on') {

		  	$client = new Client();

			$query = DB::getInstance()->get("client", "*", ["email" => Input::get('email')]);
			if ($query->count()) {
	         	foreach($query->results() as $row) {
	 	         $clientid = $row->clientid;
	            }

				$token = Token::generate();
				$studentUpdate = DB::getInstance()->update('client',[
				    'tokencode' => $token
				],[
				    'clientid' => $clientid
				  ]);

			    $id = base64_encode($clientid);
                $test = $_SERVER['HTTP_HOST'];
				$email = Input::get('email');
				$message= "
					   <p>Hello , $email</p>
					   <br /><br />
					   <p>We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore this email,</p>
					   <br /><br />
					   <p>Click Following Link To Reset Your Password</p>
					   <br /><br />
					   <a href='". $url ."reset.php?id=$id&code=$token'>click here to reset your password</a>
					   <br /><br />
					   thank you :)
					   ";
			    $subject = "Password Reset";

			    sendMail($email,$message,$subject,$title,$smail,$smailpass);

			    $noError = true;

			} else {
				$hasError = true;
			}

		 } else {

		  	$freelancer = new Freelancer();

			$query = DB::getInstance()->get("freelancer", "*", ["email" => Input::get('email')]);
			if ($query->count()) {
	         	foreach($query->results() as $row) {
	 	         $freelancerid = $row->freelancerid;
	            }

				$token = Token::generate();
				$studentUpdate = DB::getInstance()->update('freelancer',[
				    'tokencode' => $token
				],[
				    'freelancerid' => $freelancerid
				  ]);

			    $id = base64_encode($freelancerid);
                $test = $_SERVER['HTTP_HOST'];
				$email = Input::get('email');
				$message= "
					   <p>Hello , $email</p>
					   <br /><br />
					   <p>We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore this email,</p>
					   <br /><br />
					   <p>Click Following Link To Reset Your Password</p>
					   <br /><br />
					   <a href='". $url ."reset.php?id=$id&code=$token'>click here to reset your password</a>
					   <br /><br />
					   thank you :)
					   ";
			    $subject = "Password Reset";

			    sendMail($email,$message,$subject,$title,$smail,$smailpass);

			    $noError = true;

			} else {
				$hasError = true;
			}

		 }


	 } else {
	     $error = '';
	     foreach ($validation->errors()->all() as $err) {
	     	$str = implode(" ",$err);
	     	$error .= '
		           <div class="alert alert-danger fade in">
		            <a href="#" class="close" data-dismiss="alert">&times;</a>
		            <strong>Error!</strong> '.$str.'
			       </div>
			       ';
	     }
      }
 }

}

?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>

	    <!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
        <title><?php echo escape($title) .' - '. escape($tagline) ; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="<?php echo escape($description); ?>">
        <meta name="keywords" content="<?php echo escape($keywords); ?>">
        <meta name="author" content="<?php echo escape($author); ?>">

		<!-- ==============================================
		Favicons
		=============================================== -->
		<link rel="shortcut icon" href="img/favicons/favicon.ico">
		<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">

	    <!-- ==============================================
		CSS
		=============================================== -->
        <!-- Style-->
        <link href="assets/css/login.css" rel="stylesheet" type="text/css" />

		<!-- ==============================================
		Feauture Detection
		=============================================== -->
		<script src="assets/js/modernizr-custom.js"></script>

		<!--[if lt IE 9]>
		 <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

</head>

<body>

	<!-- Paste this code after body tag -->
    <div class="loader">
	<div class="se-pre-con"></div>
    </div>

 <?
$basename = basename($_SERVER["REQUEST_URI"], ".php");
$editname = basename($_SERVER["REQUEST_URI"]);
$test = $_SERVER["REQUEST_URI"];
?>

     <!-- ==============================================
     Banner Login Section
     =============================================== -->
	 <section class="banner-login">
		 <a href="index.php" class="btn btn-success btn-lg" style="border-radius:0px;">Home</a>

	  <div class="container">

	   <div class="row">

	    <main class="main main-signup col-lg-12">
	     <div class="col-lg-6 col-lg-offset-3 text-center">

	        <?php if(isset($hasError)) { //If errors are found ?>
	        <div class="alert alert-danger fade in">
	         <a href="#" class="close" data-dismiss="alert">&times;</a>
	         <strong><?php echo $lang['hasError']; ?></strong><?php echo $lang['forgot_error']; ?>
		    </div>
	        <?php } ?>

	        <?php if (isset($error)) {
				echo $error;
			} ?>

		  <?php if(isset($noError) && $noError == true) { //If email is sent ?>
		   <div class="alert alert-success fade in">
		   <a href="#" class="close" data-dismiss="alert">&times;</a>
		   <strong><?php echo $lang['noError']; ?></strong> <?php echo $lang['forgot_error_one']; ?> <?php echo $email; ?>. <?php echo $lang['forgot_error_two']; ?></strong>.
		   </div>
		  <?php } ?>

		  <div class="form-sign">
		   <form method="post">
		    <div class="form-head">
			 <h3><?php echo $lang['reset_password']; ?></h3>
			</div><!-- /.form-head -->
            <div class="form-body">

            <!-- List group -->
            <ul class="list-group">
             <li class="list-group-item">
              <div class="material-switch pull-center">
	           <span class="pull-left"><?php echo $lang['freelancer']; ?></span>
                <input id="someSwitchOptionDefault" name="user_type" type="checkbox"/>
                <label for="someSwitchOptionDefault" class="label-success"></label>
	           <span class="pull-right"><?php echo $lang['client']; ?></span>
              </div>
             </li>
            </ul>

			 <div class="form-row">
			  <div class="form-controls">
			   <input name="email" placeholder="<?php echo $lang['email']; ?>" class="field" type="text">
			  </div><!-- /.form-controls -->
			 </div><!-- /.form-row -->

		    </div><!-- /.form-body -->

			<div class="form-foot">
			 <div class="form-actions">
              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
			  <input value="<?php echo $lang['reset_password']; ?>" class="form-btn" type="submit">
			 </div><!-- /.form-actions -->
			</div><!-- /.form-foot -->
		   </form>

		  </div><!-- /.form-sign -->
	     </div><!-- /.col-lg-6 -->
        </main>

	   </div><!-- /.row -->
	  </div><!-- /.container -->
     </section><!-- /section -->

     <!-- ==============================================
	 Scripts
	 =============================================== -->

     <!-- jQuery 2.1.4 -->
     <script src="assets/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
     <!-- Bootstrap 3.3.6 JS -->
     <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
     <!-- Typed JS -->
     <script src="assets/js/typed.min.js" type="text/javascript"></script>
     <!-- Kafe JS -->
     <script src="assets/js/kafe.js" type="text/javascript"></script>

</body>
</html>
