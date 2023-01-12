<?php 
    require('_header.php');
    $verify = $DB->query("SELECT * FROM _client WHERE idClient=1");
    echo "Value is : ".$verify[0]->connecte;
?>