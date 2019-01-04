<?php

if (isset($_POST["resetPasswordSubmit"])){

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordRepeat"];

    if(empty($password)|| empty($passwordRepeat)){
        header("Location: ../newPassword.php?newPassword=empty");
    }
    else if ($password != $passwordRepeat){
        header("Location: ../newPassword.php?newPassword=empty");
        exit();
    }

    $currentDate = date("U");
    include_once 'dbh.inc.php';

    $sql = "SELECT * FROM userPwdReset WHERE pwdResetSelector =? AND pwdResetExpires >=?";
    $preparedStatement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($preparedStatement, $sql)){
        echo "Error?!";
        exit();
    } 
    else {
        mysqli_stmt_bind_param($preparedStatement, "ss", $selector, $currentTime); //probably wrong
        mysqli_stmt_execute($preparedStatement);

        $result = mysqli_stmt_get_results($preparedStatement);
        if (!$row = mysqli_fetch_assoc($result)){
            echo "Re-submit reset request";
            exit();
        }
        else {
            $tokenBinary = hex2bin($validator);
            $tokenCheck = password_verify($tokenBinary, $row["pwdResetToken"]);
            if($tokenCheck == false){
                echo "Re-submit reset request";
                exit();
            }
            else if($tokenCheck === true){

                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM users WHERE user_email=?;";
                $preparedStatement = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($preparedStatement, $sql)){
                echo "Error?!";
                exit();
                } 
                else {
                    mysqli_stmt_bind_param($preparedStatement, "s", $tokenEmail);
                    mysqli_stmt_execute($preparedStatement);

                    $result = mysqli_stmt_get_results($preparedStatement);
                    if (!$row = mysqli_fetch_assoc($result)){
                        echo "There was an error";
                        exit();
                        }
                        else {

                            $sql = "UPDATE users SET userPwdReset=? WHERE user_email=?";
                            $preparedStatement = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($preparedStatement, $sql)){
                            echo "Error?!";
                            exit();
                            } 
                            else {
                                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($preparedStatement, "ss", $hashedPassword, $tokenEmail);
                                mysqli_stmt_execute($preparedStatement);
                                
                                $sql = "DELETE FROM userPwdReset WHERE pwdResetEmail=?";
                                $preparedStatement = mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($preparedStatement, $sql)){
                                    echo "Error?!";
                                    exit();
                                } 
                                else {
                                    mysqli_stmt_bind_param($preparedStatement, "s", $email);
                                    mysqli_stmt_execute($preparedStatement);
                                    header("Location: ../signup.php?password=updated");
    }

                            }

                        }
                }

            }
        }
        }
    }


else{
    header("Location: ../index.php");
}


?>