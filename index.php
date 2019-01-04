<?php
	include_once 'header.php';
?>
    <link rel="stylesheet" type= "text/css" href="style1.css"
    <section class="main-container">
        <div class= "main-wrapper">
        
            <?php
                if(isset($_SESSION['u_id'])) {
                    echo '<p><font size = 6><br><br><br>Shall we begin?<br></font></p>';
                    echo '<p><a href="create.php"><br><img src = "create.png" alt = "Create" ></a></p>';
                }
                else{
                    echo'<p><font size = 6><br><br><br>Discover clear and simple ways to present your data...<br></font></p>';
                    echo '<p><a href="signup.php"><br><img src = "SignUpButton.png" alt = "Sign Up" ></a></p>';
                }
                    //header("Location:../create.php");
                
            ?>

        </div>
    </section>
<?php	
	include_once 'footer.php';
?>
	