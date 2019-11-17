<?php
	session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Inside Site</title>
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<div class="form">
		<h1>Inside Portal</h1>

		<img class = "image" alt="Gif" src="https://media.giphy.com/media/RDbZGZ3O0UmL6/giphy.gif" >

		<form action = "logout.inc.php" method = "post" name="logout">
			<input name="logout-submit" type="submit" value="Logout" />
		</form>

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
