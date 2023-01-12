<?php
    include 'algoLuhn.php';
    if(isset($_GET['cb'])){
        if(valideCB($_GET['cb'])){
            echo "La carte est valide";
        }
        else{
            echo "La carte n'est pas valide";
        }
    }
?>
<form method="get" action="testAlgo.php">
    <input type="number" name="cb">
    <input type="submit" value="Submit">
</form>