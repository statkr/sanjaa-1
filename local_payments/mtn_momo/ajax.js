function showRegisterForm() {
  $(".loginBox").fadeOut("fast", function() {
    $(".registerBox").fadeIn("fast");
    $(".login-footer").fadeOut("fast", function() {
      $(".register-footer").fadeIn("fast");
    });
    $(".modal-title").html("Register with");
  });
  $(".error")
    .removeClass("alert alert-danger")
    .html("");
}
function showLoginForm() {
  $("#loginModal .registerBox").fadeOut("fast", function() {
    $(".loginBox").fadeIn("fast");
    $(".register-footer").fadeOut("fast", function() {
      $(".login-footer").fadeIn("fast");
    });

    $(".modal-title").html("Login with");
  });
  $(".error")
    .removeClass("alert alert-danger")
    .html("");
}

function openLoginModal(mile, budget) {
  $('#id').val(mile) ;
  $('#budget').val(budget) ;
  $('#amount_m').text(budget) ;
  showLoginForm() ;
  setTimeout(function() {
    $("#loginModal").modal("show");
  }, 230);
}
function openRegisterModal() {
  showRegisterForm();
  setTimeout(function() {
    $("#loginModal").modal("show");
  }, 230);
}

function loginAjax() {
  var tel = $('#tel').val();
  var id = $('#id').val() ;
  //test if the phone number matches a valid mtn cameroon number
  var pattern = new RegExp(/^6[875][0-9]{7}$/);
  if (pattern.test(tel)) {
   $('#loader').show() ;
   $('#payinfo').show() ;
   $.ajax({
    type: "GET",
    url: "../local_payments/mtn_momo/pay.php",
    data: {
      _tel:tel ,
      id:id
    },
    success: function(html) {
    $('#loader').hide() ;
    $('#payinfo').hide() ;  
    alert(html)  ;   
      if (html == 1) {
         setTimeout(function() {
          $(".error").show() ;
          $(".error").val("Payment Completed successfully.") ;
          $(".error").addClass("alert-success");
        }, 10000);
          $(".error").removeClass("alert-success");
          $(".error").hide() ;
      }else if(html == 0) {
        alert(tel) ;
        shakeModal("Payment did not go successfully");
      }
    }
  });
  }else{
    shakeModal("Please Enter a Valid Mtn Cameroon Number");
  }
}


function shakeModal(cause) {
  $(".error").show() ;
  $("#loginModal .modal-dialog").addClass("shake");
  $(".error")
    .addClass("alert alert-danger")
    .html(cause);
  setTimeout(function() {
    $("#loginModal .modal-dialog").removeClass("shake");
  }, 1000);
  setTimeout(function() {
    $("#loginModal .modal-dialog").removeClass("shake");
    $(".error").removeClass("alert-danger");
    $(".error").hide();
  }, 5000);
}
