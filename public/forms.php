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
			<label for='to'>To</label>
			<input id="to" name="to" type="text">
		</p>
		<p>
			<label for='from'>From</label>
			<input id="from" name="from" type="text">
		</p>
		<p>
			<label for='Subject'>Subject</label>
			<input id="Subject" name="Subject" type="text">
		</p>
		<p>
			<textarea id="email_body" name="email_body" rows="20" cols="100" placeholder="Body"></textarea>
		</p>
		<p>
			<label >
				Would you like to save a copy to your sent Folder?
				<input type="checkbox"  value="YES" checked>
			</label>
		</p>
		<p>
			<button type="Submit" name="Submit">Send</button>
		</p>
	</form>

		<h3>"Multiple Choice Test"</h3>
	<form>
		<p>What is the capital of Texas?</p>
			<label for="q1a">
			    <input type="radio" id="q1a" name="q1" value="houston">
			    Houston
			</label><br>
			<label for="q1b">
			    <input type="radio" id="q1b" name="q1" value="dallas">
			    Dallas
			</label><br>
			<label for="q1c">
			    <input type="radio" id="q1c" name="q1" value="austin">
			    Austin
			</label><br>
			<label for="q1d">
			    <input type="radio" id="q1d" name="q1" value="san antonio">
			    San Antonio
			</label>
			<br>
		<p>Who Shot President Kennedy?</p>
			<label for="who1">
			    <input type="radio" id="who1" name="q2" value="John Ruby">
			    John Ruby
			</label><br>
			<label for="who2">
			    <input type="radio" id="who2" name="q2" value="Lee Harvey Oswald">
			    Lee Harvey Oswald
			</label><br>
			<label for="who3">
			    <input type="radio" id="who3" name="q2" value="Steven F Austin">
			    Steven F Austin
			</label><br>
			<label for="who4">
			    <input type="radio" id="who4" name="q2" value="Marilym Monroe">
			    Marilym Monroe
			</label>
			<br>
			<br>
		<p>What operating systems have you used?</p>
			<label 
			for="os1">
			<input type="checkbox" id="os1" name="os[]" value="linux"> Linux
				</label>
				<label
			 		for="os2"><input type="checkbox" id="os2" name="os[]" value="osx"> OS X
				</label>
				<label
			 		for="os3"><input type="checkbox" id="os3" name="os[]" value="windows"> Windows
				</label>
				<br>
				<br>
			<input type="Submit" value="Submit">
	</form>
</body>

