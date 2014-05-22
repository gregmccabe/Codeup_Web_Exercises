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
	        <input id="username" name="username" type="text">
	    </p>
	    <p>
	        <label for="password">Password</label>
	        <input id="password" name="username" type="password">
	    </p>
	    <p>
	        <input type="submit">
	    </p>
	</form>
</body>

