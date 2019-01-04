<?php
    include_once 'header.php';
    if(isset($_SESSION['u_id'])) {
      $username = $_SESSION['u_uid'];
      $userID = $_SESSION['u_id'];
      echo '<p><font size = 6><br><br><br></p>';
      echo $username;
      echo', you are just one step away from creating...<br></font></p>';
      ?>
      <p><font size = 4><br>Simply enter your data below, and we'll do the rest.<br><br></font></p>
      <p><font size = 2><br>Enter values in comma seperated format eg. London, Newcastle... or 950500,678000...<br><br></font></p>
      <form class="signup-form" action="create.inc.php" method="POST">
      <input type="string" name="title" placeholder="Graph Title">
      <input type="string" name="variable" placeholder="Variables">
      <input type="string" name="frequencyType" placeholder="Frequency Type">
			<input type="string" name="frequency" placeholder="Frequencies">
			<button type= "submit" name="submit"href = "bar.php">Create</button>
      </form>
      <?
    }
      else{
        echo '<p><font size = 6><br><br><br>Please log in or sign up to continue creating...<br></font></p>
        <p><a href="signup.php"><br><img src = "SignUpButton.png" alt = "Sign Up" ></a></p>';
      }
  
?>

</div>
<?php	
	include_once 'footer.php';
?>
