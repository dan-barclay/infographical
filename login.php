<?php
	include_once 'header.php';
?>
    <section class="main-container">
        <div class= "main-wrapper">
            <h2>Log In</h2>
			<form class="signup-form" action = "login.inc.php" method = "POST">
            <input type = "text" name= "uid" placeholder = "Username/e-mail">
            <input type = "password" name= "pwd" placeholder = "Password">
            <button type = "submit" name="submit">Login</button>
            </form> 

        </div>
    </section>
<?php	
	include_once 'footer.php';
?>