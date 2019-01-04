<?php
if (isset($_POST['submit'])) { //only allows users to enter if they press button
	
    include_once 'dbh.inc.php';
    
    $selectorToken = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $resetURL = "Location: ../newPassword.php?selector=".$selectorToken."&validator=" .bin2hex($token);

    $expire = date("U") + 1800; //sets expiry date for link to 1 hour.

	$email = $_POST['email']; 

    $sql = "DELETE FROM userPwdReset WHERE pwdResetEmail=?";
    $preparedStatement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($preparedStatement, $sql)){
        echo "Error?!";
        exit();
    } 
    else {
        mysqli_stmt_bind_param($preparedStatement, "s", $email);
        mysqli_stmt_execute($preparedStatement);
    }

    $sql = "INSERT INTO userPwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";

    if(!mysqli_stmt_prepare($preparedStatement, $sql)){
        echo "Error?!";
        exit();
    } 
    else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($preparedStatement, "ssss", $email, $selectorToken, $hashedToken, $expire);
        mysqli_stmt_execute($preparedStatement);
    }

    mysqli_stmt_close($preparedStatement);
    mysqli_close($conn);

    $userEmail = $email;
    $subject = 'Reset your password for Infographical';

    $message = '<p>We recieved a password reset request. The link to reste your password is below. If you did not make this request, you can ignore this.</p>';
    $message .= '<p>Here is your password reset link: <br>';
    $message .= '<a href= "'.$resetURL.'">'.$resetURL.'</a></p>';

    $headers = "From: Dan <dan@danbarclay.com>\r\n";
    $headers .= "Reply-To: dan@danbarclay.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($userEmail, $subject, $message, $headers);

    header("Location: ../resetPassword.php?reset=success");

}
else{
    //header("Location: ../index.php");
}




?>