<?php

if (isset($_POST['submit'])) { //only allows users to enter if they press button
	
	include_once 'dbh.inc.php';
	
	$first =$_POST['first']; //prevents php code being entered and ran on database
	$last =$_POST['last'];
	$email =$_POST['email'];
	$uid = $_POST['uid'];
	$pwd = $_POST['pwd'];
	
	//error handlers
	// could include do not allow "admin" for username
	// could include letter and number in password
	//check for empty fields
	if(empty($first) || empty($last) || empty($email)|| empty($uid)|| empty($pwd)){
		header("Location: ../signup.php?signup=empty");
		exit();
	}else {
		//check if input characters are valid
		if (!preg_match("/^[a-zA-Z]*$/", $first)|| !preg_match("/^[a-zA-Z]*$/", $last )){
			header("Location: ../signup.php?signup=invalid");
			exit();
			
		}else {
			//check if email is valid, contains @
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				header("Location: ../signup.php?signup=email");
				exit();
			}
				else{
					$sql = "SELECT * FROM users WHERE user_uid= '$uid'";
					$result = mysqli_query($conn,$sql);
					$resultCheck = mysqli_num_rows($result);
					//checks for already existing username
					if ($resultCheck > 0){
						header("Location: ../signup.php?signup=usertaken");
						exit();
					} 
					else{						
							$sql = "SELECT * FROM users WHERE user_email= '$email'";
							$result = mysqli_query($conn,$sql);
							$resultCheck = mysqli_num_rows($result);
							if ($resultCheck > 0){
								header("Location: ../signup.php?signup=emailtaken");
								exit();
							} 					
						else{
						//Hashing the password
						$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
						//insert the user into database
						$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd');";
						$result = mysqli_query($conn, $sql);
						print $sql;
						if($result == TRUE){
							header("Location: ../login.php");
						}else{
							print "error";
						}
						exit();
						}
					}
					
				}
			
		}
			
		}
	}
else{
	
	header("Location: ../signup.php");
	exit();
}