<!DOCTYPE html>
<html lang="en">
<head>
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  
  <script type="text/javascript">
    Stripe.setPublishableKey('pk_test_FcQOIw899GOaySY9blivMncY');
    
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.submit-button').removeAttr("disabled");
            document.getElementById('a_x200').style.display = 'block';
            $(".payment-errors").html(response.error.message);
        } else {
            var form$ = $("#payment-form");
            var token = response['id'];
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            form$.get(0).submit();
        }
    }
  </script>
</head>

<body>
  <form action="" method="POST" id="payment-form" class="form-horizontal">
    
    <noscript>
      <h4>JavaScript is not enabled!</h4>
      <p>This payment form requires your browser to have JavaScript enabled. Please activate JavaScript and reload this page. Check <a href="http://enable-javascript.com" target="_blank">enable-javascript.com</a> for more informations.</p>
    </noscript>
    
    <?php
  require 'lib/Stripe.php';
   
  if ($_POST) {
    Stripe::setApiKey("sk_test_p3kVbTEGDWBP9GwCpFQCWgSF ");
    $error = '';
    $success = '';
  
    try {
  	if (empty($_POST['street']) || empty($_POST['city']) || empty($_POST['zip']))
        throw new Exception("Fill out all required fields.");
      if (!isset($_POST['stripeToken']))
        throw new Exception("The Stripe Token was not generated correctly");
        
      /* First product */
      Stripe_Charge::create(array("amount" => 3000,
                                  "currency" => "gbp",
                                  "card" => $_POST['stripeToken'],
  								                "description" => $_POST['email']));
      /* Second product
      Stripe_Charge::create(array("amount" => 3000,
                                  "currency" => "gbp",
                                  "card" => $_POST['stripeToken'],
  								                "description" => $_POST['email']));
      */
  								
  								
      $success = '<div class="alert alert-success">
                  <strong>Success!</strong> Your payment was successful.
  				</div>';
    }
    catch (Exception $e) {
  	$error = '<div class="alert alert-danger">
  			  <strong>Error!</strong> '.$e->getMessage().'
  			  </div>';
    }
  }
  ?>
    <div class="alert alert-danger" id="a_x200" style="display: none;"> <strong>Error!</strong> <span class="payment-errors"></span> </div>
    <span class="payment-success">
    <?= $success ?>
    <?= $error ?>
    </span>
    <fieldset>
    
    <!-- Form Name -->
    <legend>Billing Details</legend>
    
    <!-- Street -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="textinput">Street</label>
      <div class="col-sm-6">
        <input type="text" name="street" placeholder="Street" class="address form-control">
      </div>
    </div>
    
    <!-- City -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="textinput">City</label>
      <div class="col-sm-6">
        <input type="text" name="city" placeholder="City" class="city form-control">
      </div>
    </div>
    
    <!-- State -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="textinput">State</label>
      <div class="col-sm-6">
        <input type="text" name="state" maxlength="65" placeholder="State" class="state form-control">
      </div>
    </div>
    
    <!-- Postcal Code -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="textinput">Postal Code</label>
      <div class="col-sm-6">
        <input type="text" name="zip" maxlength="9" placeholder="Postal Code" class="zip form-control">
      </div>
    </div>
    
    <!-- Country -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="textinput">Country</label>
      <div class="col-sm-6"> 
        <!--input type="text" name="country" placeholder="Country" class="country form-control"-->
        <div class="country bfh-selectbox bfh-countries" name="country" placeholder="Select Country" data-flags="true" data-filter="true"> </div>
      </div>
    </div>
    
    <!-- Email -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="textinput">Email</label>
      <div class="col-sm-6">
        <input type="text" name="email" maxlength="65" placeholder="Email" class="email form-control">
      </div>
    </div>
    </fieldset>
    <fieldset>
      <legend>Card Details</legend>
      
      <!-- Card Holder Name -->
      <div class="form-group">
        <label class="col-sm-4 control-label"  for="textinput">Card Holder's Name</label>
        <div class="col-sm-6">
          <input type="text" name="cardholdername" maxlength="70" placeholder="Card Holder Name" class="card-holder-name form-control">
        </div>
      </div>
      
      <!-- Card Number -->
      <div class="form-group">
        <label class="col-sm-4 control-label" for="textinput">Card Number</label>
        <div class="col-sm-6">
          <input type="text" id="cardnumber" maxlength="19" placeholder="Card Number" class="card-number form-control">
        </div>
      </div>
      
      <!-- Expiry-->
      <div class="form-group">
        <label class="col-sm-4 control-label" for="textinput">Card Expiry Date</label>
        <div class="col-sm-6">
          <div class="form-inline">
            <select name="select2" data-stripe="exp-month" class="card-expiry-month stripe-sensitive required form-control">
              <option value="01" selected="selected">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            <span> / </span>
            <select name="select2" data-stripe="exp-year" class="card-expiry-year stripe-sensitive required form-control">
            </select>
            <script type="text/javascript">
              var select = $(".card-expiry-year"),
              year = new Date().getFullYear();
   
              for (var i = 0; i < 12; i++) {
                  select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
              }
          </script> 
          </div>
        </div>
      </div>
      
      <!-- CVV -->
      <div class="form-group">
        <label class="col-sm-4 control-label" for="textinput">CVV/CVV2</label>
        <div class="col-sm-3">
          <input type="text" id="cvv" placeholder="CVV" maxlength="4" class="card-cvc form-control">
        </div>
      </div>
      
      <!-- Submit -->
      <div class="control-group">
        <div class="controls">
          <center>
            <button class="btn btn-success" type="submit">Pay Now</button>
          </center>
        </div>
      </div>
    </fieldset>
  </form>
  </body>
</html>
