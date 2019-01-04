<?php
	include_once 'header.php';
?>
    <section class="main-container">
        <div class= "main-wrapper">
            <h2>Reset Password</h2>
            <p><br>An email will be sent to you, allowing you to reset your password.</p>
			<form class="signup-form" action="resetPasswordRequest.inc.php" method="POST">
			<input type="text" name="email" placeholder="Email Address">
			<button type= "submit" name="submit">Reset Password</button>
            </form>
            <?php
                if (isset($_GET["reset"])){
                    if ($_GET["reset"]=="success"){
                        echo '<p>Check your email!</p>';
                    }
                }

            ?>
		</div>
		
    </section>
<?php	
	include_once 'footer.php';
?>
	