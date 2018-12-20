<?php


// Preventing direct access to the script, because it must be included by the "include" directive. The "BOOTSTRAP" constant is declared during system initialization.
defined('BOOTSTRAP') or die('Access denied');

// Here are two different contexts for running the script.
if (defined('PAYMENT_NOTIFICATION')) {
    /**
     * Receiving and processing the answer
     * from third-party services and payment systems.
     */
	$pp_response = array();
	
	if($_GET['mode'] != "success"){
		$pp_response['order_status'] = 'F';
		$pp_response['reason_text'] = "Not enough funds for the Purchase";
		
	}else{
		$pp_response['order_status'] = 'P';
	}
   
	
	fn_print_r($_GET['mode']) ;	
    fn_finish_payment($_REQUEST['order_id'], $pp_response);   
    fn_order_placement_routines('route', $_REQUEST['order_id']);
      
    
} else {
  /**
   * Running the necessary logics for payment acceptance
   * after the customer presses the "Submit my order" button.
   */
   $post_data = array(  'trans_id' => $order_id, 'amount_total' => $order_info['total'] ) ;

   fn_create_payment_form('http://www.marche.cm/momo/index.php', $post_data, 'momo');
   fn_print_r("Sending data");
    
    exit;
}









