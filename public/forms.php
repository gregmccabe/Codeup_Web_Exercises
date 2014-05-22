<!DOCTYPE html>
<html>
	<head>
	<title>"My First HTML Form"</title>
	</head>
		<?php
        	var_dump($_GET);
        	var_dump($_POST);

		?>
<body>
	<form method="POST">
    	<p>
	        <label for="username">Username</label>
	        <input id="username" name="username" type="text" placeholder="User Name">
	    </p>
	    <p>
	        <label for="password">Password</label>
	        <input id="password" name="password" type="password" placeholder="Password?">
	    </p>
	    <p>
	        <button type="Submit" name="Submit">Log In</button>
	    </p>
	</form>
</body>

