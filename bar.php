<?php
    include_once 'header.php';

    include_once 'dbh.inc.php';

    $urlBar = "graph.php?graphType=bar";
    $urlPie = "graph.php?graphType=pie";
    $urlLine = "graph.php?graphType=line";
    $urlDoughnut = "graph.php?graphType=doughnut";
    $urlRadar = "graph.php?graphType=radar";
    $urlHorizontal = "graph.php?graphType=horizontalBar";
    $urlPolar = "graph.php?graphType=polarArea";
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

<?php

$type = $_REQUEST['graphType'];

include_once 'graph.inc.php'; //call function instead

echo "<p><a href=savedGraph.php>Click here for saved graphs...</a></p>";
?>
</div>             


</body>

</html>
















