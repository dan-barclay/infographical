<?
include_once 'header.php';

include_once 'dbh.inc.php';

?>

<?php

include_once 'function.php';

$userDataID = $_REQUEST['createGraphic']; //get from end of url
//$sql = "SELECT * FROM userData WHERE user_dataid = $userDataID";
$sql = "SELECT AES_DECRYPT(user_variable, '$key') AS user_variable, AES_DECRYPT(user_frequency, '$key') AS user_frequency, AES_DECRYPT(user_title, '$key') AS user_title, AES_DECRYPT(user_frequencyType, '$key') AS user_frequencyType FROM userData WHERE user_dataid = $userDataID";
$result = mysqli_query($conn, $sql);
//print "HEres the result ".$result;
$resultCheck = mysqli_num_rows($result);
$assignedColours = array();
$selectedColours = array();


    if($row = mysqli_fetch_assoc($result)){
        
        $variables = htmlspecialchars_decode($row['user_variable'], ENT_QUOTES);
        $frequency = htmlspecialchars_decode($row['user_frequency'], ENT_QUOTES);
        $title = htmlspecialchars_decode($row['user_title'], ENT_QUOTES);
        $frequencyType = htmlspecialchars_decode($row['user_frequencyType'], ENT_QUOTES);
        $type = $_REQUEST['graphType'];

        $variablesArray = explode(',', $variables);
        $frequencyArray = explode(',', $frequency);

        //require 'function.php';

        $assignedColours = randomColourArray($frequencyArray);

    }
    else{
    //header("Location: ../savedGraph.php?data=userDataID");
      //  exit();
    } 
    $urlBar = "savedGraph.inc.php?createGraphic=$userDataID&graphType=bar";
    $urlPie = "savedGraph.inc.php?createGraphic=$userDataID&graphType=pie";
    $urlLine = "savedGraph.inc.php?createGraphic=$userDataID&graphType=line";
    $urlDoughnut = "savedGraph.inc.php?createGraphic=$userDataID&graphType=doughnut";
    $urlRadar = "savedGraph.inc.php?createGraphic=$userDataID&graphType=radar";
    $urlHorizontal = "savedGraph.inc.php?createGraphic=$userDataID&graphType=horizontalBar";
    $urlPolar = "savedGraph.inc.php?createGraphic=$userDataID&graphType=polarArea";
    
?>

<ul>
    <li><a href="<?php echo $urlBar ?>">Bar</a>
    <li><a href="<?php echo $urlPie ?>">Pie</a>
    <li><a href="<?php echo $urlLine?>">Line</a>
    <li><a href="<?php echo $urlDoughnut ?>">Doughnut</a>
    <li><a href="<?php echo $urlRadar ?>">Radar</a> 
    <li><a href="<?php echo $urlHorizontal ?>">Horizontal Bar</a>  
    <li><a href="<?php echo $urlPolar ?>">Polar Area</a>   
     
</ul>

<form class="signup-form"  method="POST"><button type= "submit" name="submit">Randomize Colours</button></form>
<button type = "submit" name="submit" onClick="window.print()">Print</button>

<div class = "container">
    <canvas id="myChart"></canvas>
    </div>
    <div class = main>
</div>


<script>
var labelArray = [<? foreach ($variablesArray as $labelValue) echo "'" . $labelValue . "',";?>];
var dataArray = [<? foreach ($frequencyArray as $dataValue) echo "'" . $dataValue . "',";?>];
var colourArray = [<? foreach ($assignedColours as $colourRandom) echo "'" . $colourRandom . "',";?>];
var title = '<?echo($title) ?>';
var type = '<?echo($type) ?>';
var frequencyType = '<?echo($frequencyType) ?>';

createGraph(labelArray, dataArray, title, type, frequencyType, colourArray);


//dataArrayTotal = dataArray.length;

/*function createRandomColour() {
var hexValues = '0123456789ABCDEF';
var colour = '#';
for (var i = 0; i < 6; i++) {
colour += hexValues[Math.floor(Math.random() * 16)];
}
return colour;
}*/


</script>  


