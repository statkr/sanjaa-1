$(document).ready(function() {
    if($("input[name=order_id]").val() != ""){
      function submiter(){
          $("#respond").submit() ;
      }
      setTimeout(submiter, 2000) ;
    }

});
