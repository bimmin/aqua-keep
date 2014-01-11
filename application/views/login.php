<!doctype html>

<html>

  <head>
  	<meta name="viewport" content="width=device-width" />
  	<link rel="stylesheet" href="/css/normalize.css" />
  	<link rel="stylesheet" href="/css/foundation.css" />

    <title>CodeIgniter Login</title>
    <meta charset="utf-8" />
  </head>

  <body>
  	<div id="wrapper">
	  	<form id="login" action="/user/process_login" method="post">
	  		<?php
	  			if($login_errors)
	  			{
	  				echo $login_errors;
	  			}
	  		?>
	  		<fieldset>
	    		<legend>Please Login</legend>
				  	<input placeholder="Email" type="text" name="email">
				  	<input placeholder="Password" type="text" name="password">
				  	<input type="submit" value="login"> 
		  </fieldset>
	  	</form>

	  	
	  	<form id="register" action="/user/process_registration" method="post">
	  		<fieldset>
		    	<legend>New User? Register here:</legend>
					<input type="text" name="first_name" placeholder="First Name" /><br />
					<input type="text" name="last_name" placeholder="Last Name" /><br />
					<input type="text" name="email" placeholder="Email address" /><br />
					<input type="password" name="password" placeholder="Password" /><br />
					<input type="password" name="confirm_password" placeholder="Confirm Password" /><br />
					<input type="submit" value="Register" />
				</fieldsest>
		</form>
	</div>

  </body>

</html>