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
		<h3>User Log In</h3>
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
	<form method="POST">
		<p>
			<h3>Compose Email</h3>
		</p>
		<p>
			<lable for='to'>To</lable>
			<input id="to" name="to" type="text">
		</p>
		<p>
			<lable for='from'>From</lable>
			<input id="from" name="from" type="text">
		</p>
		<p>
			<lable for='Subject'>Subject</lable>
			<input id="Subject" name="Subject" type="text">
		</p>
		<p>
			<textarea id="email_body" name="email_body" rows="20" cols="100"></textarea>
		</p>
		<p>
			<button type="Submit" name="Submit">Send</button>
		</p>
	</form>
</body>

