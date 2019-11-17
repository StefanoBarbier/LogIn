<?php

if(isset($_POST['signup-submit'])){

	require 'dbh.inc.php';

	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];


	//Error Handlers

	//if not all the fields are filled in
	if (empty($username)  ||  empty($email) ||  empty($password) ||  empty($passwordRepeat)) {
		header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
		exit(); //stops the script from running if the user makes a mistake inputting fields
	}
	//invalid username and password
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../signup.php?error=invalidmailuid&uid=");
		exit(); 
	}
	//if the email is an invalid email address
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../signup.php?error=invalidmail&mail=".$username);
		exit(); 
	}
	//if the username is invalid
	else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../signup.php?error=invaliduid&mail=".$email);
		exit(); 
	}
	//if both passwords do not match
	else if ($password !== $passwordRepeat) {
		header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
		exit();
	}
	//does the username already exist in the database
	else {
		$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../signup.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				header("Location: ../signup.php?error=usertaken&mail".$email);
				exit();
			}
			else {
				$sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?,?,?)";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: ../signup.php?error=sqlerror1");
					exit();
				}
				else{
					//hash the password
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
					mysqli_stmt_execute($stmt);

					//start the session
					session_start();
					$_SESSION['userId'] = $row['idUsers'];
					$_SESSION['userUid'] = $row['uidUsers'];

					header("Location: ../includes/internal.php?signup=success");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

}
//if they got to the page without clicking submit
else {
	header("Location: ../signup.php");
	exit();
}




