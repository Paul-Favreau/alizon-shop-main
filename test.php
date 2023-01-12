<?php
    require('_header.php');
    $verify = $DB->query("SELECT * FROM _client WHERE idClient=1");
    $id = $verify[0]->idClient;
    $verify = $DB->query("CREATE OR REPLACE EVENT e_livr1_".$id." ON SCHEDULE AT CURRENT_TIMESTAMP + 1 MINUTES DO
    BEGIN
    UPDATE alizon_sprint_3._client set connecte=1 WHERE idClient=:id;
    END;
    
    CREATE OR REPLACE EVENT e_livr2_".$id." ON COMPLETION OF e_livr1_".$id." AFTER INTERVAL 1 MINUTES DO
    BEGIN
    UPDATE alizon_sprint_3._client set connecte=2 WHERE idClient=:id;
    END;
    
    CREATE OR REPLACE EVENT e_livr3_".$id." ON COMPLETION OF e_livr2_".$id." AFTER INTERVAL 1 MINUTES DO
    BEGIN
    UPDATE alizon_sprint_3._client set connecte=0 WHERE idClient=:id;
    END;", array('id'=>1));
    echo "<a href='testview.php'>Continue?</a>";
    /* Status :
    en cours de traitement
    en transit
    en attente d'acheminement
    en cours d'acheminement
    livré */
?>