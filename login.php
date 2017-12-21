<!DOCTYPE html>
<html lang="en">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>WaveSound | Log In</title>

	<!-- font + fav icon -->
	<link rel="icon" type="image/png" href="img/logo.png">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

	<!-- style -->
	<link rel="stylesheet" type="text/css" href="css/style.css" />

</head>

<body>

	<?php include '/connessione.php';?>

	<header>
		<div class="header-container">
			<div class="header-left">
				<a id="link-home" href="index.html">
					<div id="logo"></div>
					<div id="brand" class="pacifico italic">WaveSound</div>
				</a>
			</div>
			<div class="header-right right">
				<div id="join-us">
					Join our community, it's 100% free
				</div>
			</div>
		</div>
	</header>

	<main class="reglog center">
		<div class="reglog-title">
			<h1>Log in your <span class="pacifico italic"> WaveSound </span> account</h1>
		</div>
		<form action="/action_page.php">
			<div class="input-text">
				<label for="email">Email</label>
				<br/>
				<input type="text" placeholder="Your e-mail address" name="email" required>
				<br/>
				<label for="password">Password</label>
				<br/>
				<input type="password" placeholder="Your password" name="password" required>
			</div>

			<button class="form-buttons" id="button-submit" type="submit" class="signupbtn">Sign Up</button>
			<button class="form-buttons" id="button-cancel" type="button" class="cancelbtn">Cancel</button>
			<br/>
			<input type="checkbox" checked="checked"> Remember me
			<br/>
			<br/>
			<a href="#">Forgot password</a> or <a href="register.html">Need new account</a>
		</form>
	</main>

	<footer>
		<div class="footer-links">
			Qua ci mettiamo tutti i link del sito. Esempio: https://www.wavesound.com.au/
			<ul>
				<li><a href="#">test1</a></li>
				<li><a href="#">test2</a></li>
				<li><a href="#">test3</a></li>
				<li><a href="#">test4</a></li>
				<li><a href="#">test5</a></li>
			</ul>
		</div>
		<div class="footer-bot">
			<div class="footer-left">
				<a href="#">Terms &amp; Conditions</a> | <a href="#">Privacy Policy</a> | <a href="#">Accessibility Policy</a>
			</div>
			<div class="footer-right"><span class="pacifico italic">Wavesound</span>&nbsp; Copyright &copy; 2017. All rights reserved.</div>
		</div>
	</footer>

</body>

</html>
