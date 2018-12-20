<?php
	 if(isset($_GET['_tel'])){
  	//the php execution time
		set_time_limit(0) ;
	 }
?>
<!DOCTYPE html>

<html>


<head>
    <meta charset="utf-8">
    <title>Complete your payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <!-- script src="jquery.min.js"></script -->
    <script src="jquery.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="script.js" type="text/javascript"></script>

    <style>
        .content {
            background-color: rgba(255, 255, 255, 0.5);
            margin-top: 60px;
        }

        body {
            background-color: #eeeeee;
            background-image: url('back1.jpg');
        }

        .logo {
            margin: 10px;
            margin-bottom: 20px;
        }

        .purchase-detaile {
            margin-top: 60px;
        }

        #formmomo {
            border-right: 1px solid #999999;
            padding-right: 10px;
        }

        .cart {
            margin-right: 10px;
            height: 80px;
        }

        #loader {
            border: 16px solid #f3f3f3;
            border-top: 8px solid #ff3333;
            border-bottom: 8px solid #ff3333;
            border-left: 8px solid #ffff00;
            border-right: 8px solid #ffff00;
            border-radius: 50%;
            width: 65px;
            height: 65px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            50% {
                transform: rotate(300deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>

<?php

      // this code executes this scipt in defrent context when the buy now button is clicked
      if(isset($_GET['_tel'])){
        $url = "https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml?idbouton=2&typebouton=PAIE&_amount=".(int)$_GET['money_amount']."&_tel=".$_GET['_tel']."&_clP=&_email=mack_babys@yahoo.com&submit.x=104&submit.y=70" ;
		//  Initiate curl
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

		        if($respond["StatusDesc"] == "General failure."){
		          $error_var = "You dont have enough Money in your Mtn Money Acount" ;
		        }elseif($respond["StatusDesc"] == "Successfully processed transaction."){
		          $succes_var = "Payment completed with success . thanks for your Purchase" ;
		        }else{
							echo "<b style= 'color:red'>error you wasted toomutch time to respond with your phone<b>" ;
							
						}
		      }

 ?>


<form method="GET" id='respond' action="http://www.marche.cm/index.php">
	<input type="hidden" value="payment_notification" name="dispatch">
    <input type="hidden" value="<?php echo isset($_GET['order_id_num']) ? $_GET['order_id_num'] : "" ; ?>" name="order_id">
    <input type="hidden" value="<?php  echo isset($error_var) ? "error" : "success" ; ?>" name="mode">
    <input type="hidden" value="mobile_money_payment" name="payment">
</form>


    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-lg-offset-2 col-xs-12 col-sm-6 col-sm-offset-2 col-md-4 col-md-offset-2 content well ">
                <div class="panel panel-default">
                    <div id="le"></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-5">

                                <form id="formmomo" method="GET" action="" target="_top">
                                    <img src="logo.png" class="logo img img-responsive" alt="">
                                    <input type="hidden" value="<?php echo $_POST['trans_id'] ?>" name="order_id_num">
                                    <input name="money_amount" value="<?php echo $_POST['amount_total'] ; ?>" type="hidden" required>
                                    <div class="form-group">
                                        <label frespor="num">Enter Your Phone Number:</label>
                                        <input pattern="6[875][0-9]{7}" class="input-sm momo host form-control" id="num" type="tel" title="Please Your Number should be a valid mtn Number" placeholder="mtnNumber" name="_tel" value="" autocomplete="off" required>
                                    </div>
                                    <input class="momo-im img img-responsive" type="image" id="Button_Image" src="https://developer.mtn.cm/OnlineMomoWeb/console/uses/itg_img/buttons/MOMO_buy_now_EN.jpg" style="width : 250px; height: 100px;" border="0" name="submit" alt="OnloneMomo, le réflexe sécurité pour payer en ligne"
                                        autocomplete="off">
                                </form>

                            </div>
                            <div class="col-lg-7">
                                <div class="container ">
                                    <img src="cart.jpeg" alt="cart" style="float:left" class="cart img img-responsive">

                                    <div class="">
                                        <h3>Your Purchase Details</h3>
                                        <div class="clearfix"></div>

                                        <table class="table table-bordered" style="width:35%">
                                            <thead>
                                                <tr>
                                                    <th>Order Id</th>
                                                    <th>Date</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo isset($_POST['trans_id']) ? $_POST['trans_id']:"" ; ?></td>
                                                    <td>02/07/17</td>
                                                    <td><?php echo isset($_POST['amount_total']) ? $_POST['amount_total']:"" ; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="row">
                                            <div class="col-lg-5 ">

                                            <?php if(isset($error_var)){ ?>
                                                <div class="alert alert-danger" style="" id="errordiv">
                                                    <p>Error the Transaction did not go Through Check the following.. <br>
                                                        <strong>*<?php echo $error_var ; ?> </strong> <br>
                                                        <strong>*Internet Connection failluer. </strong> <br>
                                                    </p>
                                                </div>

                                            <?php }elseif(isset($succes_var)){ ?>

                                                <div class="alert alert-success" style="" id="successdiv">
                                                    <p>Transaction correctly went Trough.. <br>
                                                        <strong>*<?php echo $succes_var ; ?> </strong> <br>
                                                    </p>
                                                </div>

                                            <?php } ?>

                                                <!-- div id="loader"></div -->

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
By Entercomms Cameroon
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>
