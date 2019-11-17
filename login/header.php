<?php
	session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<div class="form">
		<h1>Log In</h1>
		<form action="includes/login.inc.php" method="post" name="login">
			<input type="text" name="mailuid" placeholder="Username/E-mail" required />
			<input type="password" name="pwd" placeholder="Password" required />
			<input name="login-submit" type="submit" value="Login" />
		</form>
		<p>Not registered yet? <a href='signup.php'>Register Here</a></p>

		<?php 
		if (isset($_SESSION['userId'])) {
			echo '<p>You are Logged In!</p>';
		}
		else {
			echo '<p>You are Logged Out!</p>';
		}
		?>
	</div>
</body>

</html>