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

		<div class="form-group">
			<label for="first_name">First Name:</label>
			<input type="text" name="first_name" id="first_name" class="form-control">
		</div>

		<div class="form-group">
			<label for="last_name">Last Name:</label>
			<input type="text" name="last_name" id="last_name" class="form-control">
		</div>

		<input type="hidden" name="user_id" id="user_id">

		<button type="submit" name="action" id="action" class="btn btn-success">Submit</button>


		<hr/>



		<div class="table-responsive" id="result">

		</div>

	</div>








	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  	<script type="text/javascript" src="js/error_codes.js"></script>

  	<script type="text/javascript">
  		$(document).ready(function() {

  			function fetchUser()
  			{
  				var setAction = "select";

  				$.ajax({
  					url: 'select.php',
  					method: "POST",
  					data: {
  						action: setAction,
  						token: <?php echo "'". $token->getCode() ."'"; ?>
  					},
  					success: function(data) {
  						// empty the input fields
  						$('#first_name').val('');
  						$('#last_name').val('');
  						
  						$('#action').text('Add User');

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


  			$('#action').click(function (event) {
  			 	event.preventDefault();
  			 	
  			});

  		});
  	</script>

</body>
</html>