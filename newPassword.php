<?php
	include_once 'header.php';
?>
    <section class="main-container">
        <div class= "main-wrapper">
        
            <?php
            $selector = $_GET["selector"];
            $validator = $_GET["validator"];

            if(empty($selector)|| empty($validator)){
                echo "Could not validate your request";
            }
            else{
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                    ?>
                    <form action ="resetPassword.inc.php" method ="post">
                        <input type= "hidden" name= "selector" value="<?php echo $selector?>">
                        <input type= "hidden" name= "validator" value="<?php echo $validator?>">
                        <input type= "password" name= "password" placeholder = "Enter a new password...">
                        <input type= "password" name= "passwordRepeat" placeholder = "Repeat new password...">
                        <button type = "submit" name= "resetPasswordSubmit">Reset Password</button>

                    <?php
                }

            }
            
            ?>

		</div>
		
    </section>
<?php	
	include_once 'footer.php';
?>