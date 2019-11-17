
<head>
	<title>Register</title>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<div class="form">
	<h1>Signup</h1>
	<form action="includes/signup.inc.php", method="post">
		<input type="text" name="uid" placeholder="Username" required>
		<input type="text" name="mail" placeholder="E-mail" required>
		<input type="password" name="pwd" placeholder="Password" required>
		<input type="password" name="pwd-repeat" placeholder="Repeat password" required>
		<input name="signup-submit" type="submit" value="Signup" />
	</form>
	</div>
</body>
