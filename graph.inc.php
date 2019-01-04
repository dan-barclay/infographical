                                
<?

include_once 'function.php';

$userID = $_SESSION['u_id'];
$sql = "SELECT AES_DECRYPT(user_variable, '$key') AS user_variable, AES_DECRYPT(user_frequency, '$key') AS user_frequency, AES_DECRYPT(user_title, '$key') AS user_title, AES_DECRYPT(user_frequencyType, '$key') AS user_frequencyType FROM userData WHERE user_id = $userID ORDER BY user_dataid DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
$assignedColours = array();
$selectedColours = array();

    if($row = mysqli_fetch_assoc($result)){
        
        
        $variables = htmlspecialchars_decode($row['user_variable'], ENT_QUOTES);
        $frequency = htmlspecialchars_decode($row['user_frequency'], ENT_QUOTES);
        $title = htmlspecialchars_decode($row['user_title'], ENT_QUOTES);
        $frequencyType = htmlspecialchars_decode($row['user_frequencyType'], ENT_QUOTES);

      /* $variables = str_replace(" &#; ", " ' ", $variables);
        $frequency = str_replace(" &#; ", " ' ", $frequency);
        $title = str_replace("&#;", "`", $title);
        $frequencyType = str_replace(" &#; ", " ' ", $frequencyType);  */

        $variablesArray = explode(',', $variables);
        $frequencyArray = explode(',', $frequency);

       

       $assignedColours = randomColourArray($frequencyArray);
    
    }

    else{
    header("Location: ../bar.php?data=error");
        exit();
    }

?>

<script>

//include_once 'function.php';

var labelArray = [<? foreach ($variablesArray as $labelValue) echo "'" . $labelValue . "',";?>];
var dataArray = [<? foreach ($frequencyArray as $dataValue) echo "'" . $dataValue . "',";?>];
var colourArray = [<? foreach ($assignedColours as $colourRandom) echo "'" . $colourRandom . "',";?>];
var title = '<?echo($title) ?>';
var type = '<?echo($type) ?>';
var frequencyType = '<?echo($frequencyType) ?>';

console.log(title);

createGraph(labelArray, dataArray, title, type, frequencyType, colourArray);

</script>  

