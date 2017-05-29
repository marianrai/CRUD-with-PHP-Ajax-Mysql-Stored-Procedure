  <?php
  	require_once 'inc/bootstrap.php';

  	$token = new TokenGenerator();
  	$_SESSION['token'] = $token->getCode();
  ?>

  <html>
  <head>
  	<title>PHP Ajax CRUD with Stored Procedure</title>
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  	<link rel="stylesheet" type="text/css" href="css/styles.css">
  </head>
  <body>





  	<div class="container box">
  		<h3>PHP Ajax CRUD - using MySql stored procedure</h3>


      <div class="feedback">
        <div class="alert alert-success alert-dismissible hidden" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <p><span class="message"></span></p>
        </div>

        <div class="alert alert-danger alert-dismissible hidden" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <p><span class="message"></span></p>
        </div>
      </div>


  		<div class="form-group">
  			<label for="first_name">First Name:</label>
  			<input type="text" name="first_name" id="first_name" class="form-control">
        <span class="help-block field-one"></span>
  		</div>

  		<div class="form-group">
  			<label for="last_name">Last Name:</label>
  			<input type="text" name="last_name" id="last_name" class="form-control">
        <span class="help-block field-two"></span>
  		</div>

  		<input type="hidden" name="user_id" id="user_id">
      <input type="hidden" name="action" id="action" value="insert">

  		<button type="submit" class="btn btn-success" id="submit">Submit</button>


  		<hr/>



  		<div class="table-responsive" id="result">

  		</div>

  	</div>








  	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    	<script type="text/javascript" src="js/error_codes.js"></script>

    	<script type="text/javascript">
    		$(document).ready(function() {


          // display all users
    			function fetchUser()
    			{
    				
    				$.ajax({
    					url: 'select.php',
    					method: "POST",
    					data: {
    						action: 'select',
    						token: <?php echo "'". $token->getCode() ."'"; ?>
    					},
    					success: function(data) {
    						// empty the input fields
    						$('#first_name').val('');
    						$('#last_name').val('');
    						
    						//$('#action').text('Add User');

    						$('#result').html(data)
    					},

    					error: function(jqXHR, textStatus, errorThrown) {
    						//console.log(textStatus +': '+ errorThrown);
    					},

    					statusCode: {
    						400: function() {
    							$('#result').html(HTML_ERROR_400);
    						},
    						401: function() {
    							$('#result').html(HTML_ERROR_401);
    						},
    						403: function() {
    							$('#result').html(HTML_ERROR_403);
    						},
    						404: function() {
    							$('#result').html(HTML_ERROR_404);
    						},
    						500: function() {
    							$('#result').html(HTML_ERROR_500);
    						},
    						501: function() {
    							$('#result').html(HTML_ERROR_501);
    						}
    					}
    				});

    			}

    			
    			fetchUser();





          // insert data 
          $('#submit').click(function (event) {

    			 	event.preventDefault();
            // reset errors
            $('.field-one').html('');
            $('.field-two').html('');

    			 	var firstName = $('#first_name').val();
    			 	var lastName = $('#last_name').val();
    			 	var userId = $('#user_id').val();
    			 	var action = $('#action').val();
            

            if (firstName.trim() == '') {
              $('.field-one').html('This field is required!');
            }
            if (lastName.trim() == '') {
              $('.field-two').html('This field is required!');
            }

            if (firstName.trim() && lastName.trim()) {
              $.ajax({
                url: "action.php",
                method: "POST",
                data: {
                  firstName:firstName,
                  lastName:lastName,
                  userId:userId,
                  action: action,
                  token: <?php echo "'". $token->getCode() ."'"; ?>
                },
                success: function(response) {
                  var data = JSON.parse(response);

                  if (! $('.feedback .alert-success').hasClass('hidden')) {
                    $('.feedback .alert-success').addClass('hidden');
                  }

                  if (! $('.feedback .alert-danger').hasClass('hidden')) {
                    $('.feedback .alert-danger').addClass('hidden');
                  }

                  if (data.success) {
                    $('.feedback .alert-success .message').html(data.success);
                    $('.feedback .alert-success').removeClass('hidden');
                  }

                  if (data.error) {
                    $('.feedback .alert-danger .message').html(data.error);
                    $('.feedback .alert-danger').removeClass('hidden');
                  }
                  
                  fetchUser();
                },


                error: function(jqXHR, status, error) {

                }
              });
            }

    			});






    		});



    	</script>

  </body>
  </html>