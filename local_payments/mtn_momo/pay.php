<?php
//Check if init.php exists
if(!file_exists('../../core/binit.php')){
	header('Location: ../../install/');        
    exit;
}else{
 require_once '../../core/binit.php';	
}

//Start new Client object
$client = new Client();

//Check if Client is logged in
if (!$client->isLoggedIn()) {
  Redirect::to('../index.php');	
}

//Getting Milestone Data
$id = Input::get('id');
$query = DB::getInstance()->get("milestone", "*", ["id" => $id, "LIMIT" => 1]);
if ($query->count() === 1) {
 foreach($query->results() as $row) {
  $milestone_budget = $row->budget;
 }
}

      // if the mtn number is available it initiates the payment process.
      if(isset($_GET['_tel'])){
        $url = "https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml?idbouton=2&typebouton=PAIE&_amount=".(int)$milestone_budget."&_tel=".$_GET['_tel']."&_clP=&_email=mack_babys@yahoo.com&submit.x=104&submit.y=70" ;
				//Initiate curl
				$ch = curl_init();
				// Disable SSL verification
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				// Will return the response, if false it print the response
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				// Set the url
				curl_setopt($ch, CURLOPT_URL,$url);
				//try to connect to the service indefinatelly
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
				//The maximum number of seconds to allow cURL functions to execute. in seconds
				curl_setopt($ch, CURLOPT_TIMEOUT, 120);
				// Execute
				$result = curl_exec($ch);
				// Closing
				curl_close($ch);

		        $respond = json_decode($result, true) ;

		        if((int)$respond["StatusCode"] == 100){
		          $error_var = "You dont have enough Money in your Mtn Money Acount" ;
		          echo $respond["StatusCode"] ;
		        }elseif((int)$respond["StatusCode"] == 01){
		          $succes_var = "Payment completed with success . thanks for your Purchase" ;
		          $Update = DB::getInstance()->update('milestone',['funded' => 1],['id' => $id]);
		          echo $respond["StatusCode"] ;
		        }else{
				  echo $respond["StatusCode"] ;				
				}
		      }


?>