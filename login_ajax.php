<?php
//Check if frontinit.php exists
if(!file_exists('core/frontinit.php')){
	header('Location: install/');
    exit;
}else{
 require_once 'core/frontinit.php';
}

//Log In Function
if (Input::exists()) {
/* if(Token::check(Input::get('token'))){*/

		if (Input::get('user_type') == 'on') {

			 //Log Client In
	     $client = new Client();

			 $remember = (Input::get('remember') === 'on') ? true : false;
			 $login = $client->login(Input::get('email'), Input::get('password'), $remember);

			 if ($login === true) {
	          // Redirect::to('Client/');
            echo "client" ;
			 }else {
         echo "error1" ;
			 }

		} else {

			 //Log freelancer In
			 $freelancer = new Freelancer();

			 $remember = (Input::get('remember') === 'on') ? true : false;
			 $login = $freelancer->login(Input::get('email'), Input::get('password'), $remember);

			 if ($login === true) {
	          // Redirect::to('Freelancer/');
            echo "freelancer" ;
			 }else {
			   //$hasError = true;
         echo "error2" ;
			 }

		}



/*	}else{
		echo "error3";
	}*/
}else {
	echo "error4";
}

?>
