<?php
    require('_header.php');
    $token = $_POST['token'];
    $newmdp = $_POST['mdp'];
    $hashednewmdp = password_hash($newmdp, PASSWORD_DEFAULT);
    $confirm = $_POST['confirmmdp'];
    $currenttime = date('Y-m-d H:i:s', strtotime('now'));
    if (isset($_POST['token'])) {
            $verify = $DB->query("select * from _client where resettoken='$token'");
                if ($verify[0]->resettokenexp < $currenttime) {
                    //echo "whoops, token expired at ".$verify[0]->resettokenexp.". Current time is ".$currenttime.".";
                    $DB->query("update _client set resettoken=null, resettokenexp=null where resettoken=:token", array('token'=>$token)); // clear token
                    header('Location:forgotmdp.php?expired=1');
                } else if ($newmdp != $confirm) {
                    header('Location:resetmdp.php?oops=1');
                } else if (count($verify) == 0) {
                    header('Location:resetmdp.php?fail=1');
                } else {
                    $DB->query("update _client set mdp=:newmdp, resettoken=null, resettokenexp=null where resettoken=:token", array('newmdp'=>$hashednewmdp, 'token'=>$token)); // changer mdp + clear token
                    //echo "bah yes. <a href='connexion.php?resetsuccess=1'>continue</a>";
                    if(isset($_SESSION['token'])){unset($_SESSION['token']);};
                    header('Location:connexion.php?resetsuccess=1');
                }
 }
?>