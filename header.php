<?php
    session_start();
?>


<!DOCTYPE html>
<html>
<head>
    
    <title>Infographical</title>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <link rel="stylesheet" type= "text/css" href="style1.css"
    
</head>
<body>
    <header>
        <nav>
            <div class="main-wrapper">
                
                    <a href= "index.php"><img src = "infographical.png" alt = "Infographical" ></a>
                
<div class= "nav-login">
<?php
    if (isset($_SESSION['u_id'])){
        echo '<form action = "logout.inc.php" method = "POST">
            <button type="submit" name="submit">Logout</button>
            </form>
            <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="create.php">Create</a></li>
            <li><a href="savedGraph.php">Saved</a></li>
            </ul>';
    }else{
        echo '<form action = "login.inc.php" method = "POST">
        <input type = "text" name= "uid" placeholder = "Username/e-mail">
        <input type = "password" name= "pwd" placeholder = "Password">
        <button type = "submit" name="submit">Login</button>
        </form>  
        <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="create.php">Create</a></li>
        <li><a href="signup.php">Sign up</a></li>
        </ul>';
    }
?>

        </nav>
        
    </header>