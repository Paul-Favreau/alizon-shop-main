<?php
    require('_header.php');
    $DB=new DB();
    $mail = $_POST['email'];
    if (isset($_POST['email'])) {
        $sql = "select * from _client where email='$mail'";
            $verify = $DB->query($sql);
                if (count($verify) > 0 && $verify[0]->bloque == 0) {
                    $token = bin2hex(openssl_random_pseudo_bytes(8)); // Si cette fonction retourne une erreur, pensez a activer (décommenter) l'extension openssl dans php.ini
                    $exp = date('Y-m-d H:i:s', strtotime('now +10 minutes')); // Pour une raison que j'ignore, "now" prend pas en compte l'heure d'hiver
                    $stmt = $DB->query('UPDATE _client SET resettoken=:resettoken, resettokenexp=:tokenexp WHERE email=:email', array('resettoken'=>$token, 'tokenexp'=>$exp, 'email'=>$mail));
                    //echo "Success! token is ".$token." expiring ".$exp.". <a href='resetmdp.php?token=".$token."'>continue</a>"; // debug
                    // ###################################
                    // ############ IMPORTANT ############
                    // ###################################
                    // Pour que le mail fonctionne en localhost, il faut avoir installer et configurer fake sendmail
                    // Plus d'infos ici : https://youtu.be/Fywr8gIVdLY?t=340
                    $subject = 'Changer votre mot de passe';

                    $message = '
                    <html>
                    <head>
                    <title>Changer votre mot de passe</title>
                    </head>
                    <body>
                    <p>Bonjour,</p>
                    <p>Vous avez fait une demande de changement de mot de passe. Si vous n\'êtes pas à l\'origine de cette demande, ignorez ce mail.</p>
                    <p><a href="http://localhost:3000/Site-de-marketplace/resetmdp.php?token='.$token.'">Pour changer votre mot de passe, cliquez ici.</a></p>
                    <p>Ce token expirera dans 10 minutes.</p>
                    <p>Cordialement,</p>
                    <p>Alizon</p>
                    </body>
                    </html>
                    ';

                    $headers[] = 'Content-type: text/html; charset=utf-8';
                    $headers[] = 'To: '.$verify[0]->prenom.' '.$verify[0]->nom.' <'.$mail.'>';
                    $headers[] = 'From: Noah Brohan <noahbrh@gmail.com>';

                    if(mail($mail, $subject, $message, implode("\r\n", $headers))) {
                        header('Location:resetmdp.php?sent=1');
                    } else {
                        echo "erreur envoi";
                    }
                    
                }
                else if ($verify[0]->bloque == 1) {
                    header('Location:connexion.php?blocked=1');
                } else {
                    header('Location:connexion.php?fail=1');
                }
 }
?>