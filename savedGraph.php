<?php

include_once 'header.php';

include_once 'dbh.inc.php';

include_once 'function.php';

echo "<h1><br><br></h1>
<table>
<tr>
    <th>Title</th>
    <th>Variables</th>
    <th>Frequency</th>
    <th>Frequency Type</th>
    <th>Saved Graphic</th>
</tr>
";


$userID = $_SESSION['u_id'];
$sql = "SELECT user_dataid FROM userData WHERE user_id = $userID";     
$result = mysqli_query($conn, $sql);
$dataIDarray = array();


while (($row = mysqli_fetch_assoc($result))){ 
    array_push($dataIDarray, $row['user_dataid']);
}

for($counter=0; $counter< count($dataIDarray); $counter++){

    $userDataID = $dataIDarray[$counter];
    //echo $userDataID;
    $userID = $_SESSION['u_id'];
    
    //$sql = "SELECT * FROM userData WHERE user_id = $userID AND user_dataid = $userDataID";
    $sql = "SELECT AES_DECRYPT(user_variable, '$key') AS user_variable, AES_DECRYPT(user_frequency, '$key') AS user_frequency, AES_DECRYPT(user_title, '$key') AS user_title, AES_DECRYPT(user_frequencyType, '$key') AS user_frequencyType FROM userData WHERE user_id = $userID AND user_dataid = $userDataID"; //ORDER BY
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    //print_r($row);
    
    if($row = mysqli_fetch_assoc($result)){
        $variables = $row['user_variable'];
        $frequency = $row['user_frequency'];
        $title = $row['user_title'];
        $frequencyType = $row['user_frequencyType'];
        

        $variablesArray = explode(',', $variables);
        $frequencyArray = explode(',', $frequency);

    }
    else{
        //header("Location: ../bar.php?data=error");
        exit();
    }
    $location = "/savedGraph.inc.php?createGraphic=$userDataID&graphType=bar";
    //$create = "/savedGraph.inc.php";
    echo "<tr>
        <td>$title</td>
        <td>$variables</td>
        <td>$frequency</td>
        <td>$frequencyType</td>";

    echo "<td><a href = $location ><img src='view.png' alt='View'></a></td>
    </tr>";
    }  
    
    echo "</table>"; 

    include_once 'footer.php';




    /*  print $variables;
    print $frequency;
    print $title;
    print $frequencyType;
    print_r($variablesArray);
    print_r($frequencyArray); */

        //include_once 'graph.inc.php'; 
    //or make javascript function for creating graph and implement frequencyArray and variablesArray into it in this loop.
    //put this at top of code and call function instead, less hacky
    //try loops in javascript for amount of values in array
  ?>