<?php

include_once 'header.php';

include_once 'function.php';

if (isset($_POST['submit'])) { //only allows users to enter if they press button
	
	include_once 'dbh.inc.php';

	if(isset($_SESSION['u_id'])){
	
	$variable = $_POST['variable'];
	$frequency = $_POST['frequency'];
	$title = $_POST['title'];
	$frequencyType = $_POST['frequencyType'];
	$userID = $_SESSION['u_id'];

	//echo $title;

	if(empty($userID)){
		header("Location: ../signup.php?user_not_logged_in");
		exit();
	}
	else{
		if(empty($variable) || empty($frequency) || empty($title) || empty($frequencyType)){
			header("Location: ../create.php?data=empty");
			exit();
		}
		else {
				//function to check for ' and replace with unicode equivalent
				//checkForApostrophe($variable, $frequency, $title, $frequencyType);
				$variable = str_replace("'", "ʼ", $variable);
				$frequency = str_replace("'", "ʼ", $frequency);
				$title = str_replace("'", "ʼ", $title);
				$frequencyType = str_replace("'", "ʼ", $frequencyType);

				$sql = ("INSERT INTO userData (user_id, user_variable, user_frequency, user_title, user_frequencyType) VALUES ($userID, AES_ENCRYPT('$variable','$key'), AES_ENCRYPT('$frequency','$key'), AES_ENCRYPT('$title','$key'), AES_ENCRYPT('$frequencyType','$key'));");
				$result = mysqli_query($conn, $sql);

				//$preparedStatement = $conn->prepare("INSERT INTO userData (user_id, user_variable, user_frequency, user_title, user_frequencyType) VALUES (?,AES_ENCRYPT(?,'$key'),AES_ENCRYPT(?,'$key'),AES_ENCRYPT(?,'$key'),AES_ENCRYPT(?,'$key');");

				/*$preparedStatement = $conn->prepare("INSERT INTO userData (user_id, user_variable, user_frequency, user_title, user_frequencyType) VALUES (?,?,?,?,?;");
				$preparedStatement->bind_param("sssss",$userID, $variable, $frequency, $title, $frequencyType);
				$preparedStatement->execute();*/

				echo $preparedStatement;
				
				if($result == TRUE){
					header("Location: ../graph.php?graphType=bar&create=success");
				}else{
					print "error";
				} 

			}
	
		}	
						
	}		
			
}

else{
	header("Location: ../signup.php?user_id_unavailable");
		exit();
}
/*
else{
	
	header("Location: ../signup.php");
	exit();
}
*/
/*	
				

				//if (){
				//header("Location: ../graph.php?graphType=bar&create=success");
				/*}
				else{
					header("Location: ../create.php?invalidCharacter=true");
				}*/

				







					
					/*$sql = ("INSERT INTO userData (user_id, user_variable, user_frequency, user_title, user_frequencyType) VALUES (?, ?, ?, ?, ?);");
					$preparedStatement = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($preparedStatement, $sql)){
						echo "Error?!";
						exit();
						} 
					else {

						mysqli_stmt_bind_param($preparedStatement, "sssss", $userID, $variable, $frequency, $title, $frequencyType);
						var_dump($preparedStatement);
						
						mysqli_stmt_execute($preparedStatement);
	
					
						  /* bind result variables 
					    mysqli_stmt_bind_result($preparedStatement, $result);

						//$result = mysqli_stmt_get_result($preparedStatement);
						//mysqli_stmt_fetch($preparedStatement);

						if ($row = mysqli_fetch_assoc($result)){
							header("Location: ../bar.php?create=success");
							}
							else{
								echo "There was an error";
							exit();
							}
					}
					/*$result = mysqli_query($conn, $sql);
					//print $sql;
*/
					
					/*if($result == TRUE){
						header("Location: ../bar.php?create=success");
					}else{
						print "error";
					} 
					exit();*/