<?php
    require('_header.php');
    $oldmdp = $_POST['oldmdp'];
    $newmdp = $_POST['newmdp'];
    $hashednewmdp = password_hash($newmdp, PASSWORD_DEFAULT);
    $confirm = $_POST['confirmmdp'];
    if (isset($_POST['token'])) {
            $verify = $DB->query("select * from _client where mdp='$oldmdp'");
                if ($newmdp != $confirm) {
                    header('Location:resetmdp.php?oops=1');
                } else if (count($verify) == 0) {
                    header('Location:resetmdp.php?fail=1');
                } else {
                    $DB->query("update _client set mdp=:newmdp, resettoken=null, resettokenexp=null where mdp=:oldmdp", array('newmdp'=>$hashednewmdp, 'oldmdp'=>$oldmdp)); // changer mdp + clear token
                    //echo "bah yes. <a href='connexion.php?resetsuccess=1'>continue</a>";
                    if(isset($_SESSION['token'])){unset($_SESSION['token']);};
                    header('Location:profil.php?resetsuccess=1');
                }
 }
?>