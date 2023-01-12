<?php
$destinataire = 'adresse@fai.com';
// Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
$expediteur = 'noahbrh@gmail.com';
$destinataire = 'noahbrh@gmail.com';
$objet = 'Bienvenue sur Alizon'; // Objet du message
$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
$headers .= 'From: "Nom_de_expediteur"<'.$expediteur.'>'."\n"; // Expediteur
$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$message = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
<!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta name='x-apple-disable-message-reformatting'>
  <!--[if !mso]><!--><meta http-equiv='X-UA-Compatible' content='IE=edge'><!--<![endif]-->
  <title></title>
  
    <style type='text/css'>
      @media only screen and (min-width: 620px) {
  .u-row {
    width: 600px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-50 {
    width: 300px !important;
  }

  .u-row .u-col-100 {
    width: 600px !important;
  }

}

@media (max-width: 620px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: 100% !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors='true'] {
  color: inherit !important;
  text-decoration: none !important;
}

table, td { color: #000000; } #u_body a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_2 .v-container-padding-padding { padding: 30px 10px 10px !important; } #u_content_image_2 .v-src-width { width: auto !important; } #u_content_image_2 .v-src-max-width { max-width: 35% !important; } #u_content_heading_1 .v-container-padding-padding { padding: 10px 20px 0px !important; } #u_content_heading_1 .v-font-size { font-size: 25px !important; } #u_content_text_2 .v-container-padding-padding { padding: 10px 10px 0px !important; } #u_content_text_3 .v-container-padding-padding { padding: 5px 10px 10px !important; } #u_content_button_1 .v-size-width { width: 65% !important; } #u_content_image_3 .v-src-width { width: auto !important; } #u_content_image_3 .v-src-max-width { max-width: 60% !important; } #u_content_heading_3 .v-container-padding-padding { padding: 0px 10px !important; } #u_content_heading_3 .v-text-align { text-align: center !important; } #u_content_text_1 .v-container-padding-padding { padding: 5px 10px 10px !important; } #u_content_text_1 .v-text-align { text-align: center !important; } #u_content_button_2 .v-container-padding-padding { padding: 10px 10px 60px !important; } #u_content_button_2 .v-text-align { text-align: center !important; } #u_content_heading_4 .v-container-padding-padding { padding: 60px 10px 0px !important; } #u_content_heading_4 .v-text-align { text-align: center !important; } #u_content_text_4 .v-container-padding-padding { padding: 5px 10px 10px !important; } #u_content_text_4 .v-text-align { text-align: center !important; } #u_content_button_3 .v-container-padding-padding { padding: 10px !important; } #u_content_button_3 .v-text-align { text-align: center !important; } #u_content_image_4 .v-src-width { width: auto !important; } #u_content_image_4 .v-src-max-width { max-width: 81% !important; } #u_content_image_5 .v-src-width { width: auto !important; } #u_content_image_5 .v-src-max-width { max-width: 60% !important; } #u_content_heading_5 .v-container-padding-padding { padding: 0px 10px !important; } #u_content_heading_5 .v-text-align { text-align: center !important; } #u_content_text_5 .v-container-padding-padding { padding: 5px 10px 10px !important; } #u_content_text_5 .v-text-align { text-align: center !important; } #u_content_button_4 .v-container-padding-padding { padding: 10px 10px 30px !important; } #u_content_button_4 .v-text-align { text-align: center !important; } #u_content_text_12 .v-container-padding-padding { padding: 10px !important; } }
    </style>
  
  

<!--[if !mso]><!--><link href='https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap' rel='stylesheet' type='text/css'><link href='https://fonts.googleapis.com/css?family=Rubik:400,700&display=swap' rel='stylesheet' type='text/css'><!--<![endif]-->

</head>

<body class='clean-body u_body' style='margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #fbfbfb;color: #000000'>
  <!--[if IE]><div class='ie-container'><![endif]-->
  <!--[if mso]><div class='mso-container'><![endif]-->
  <table id='u_body' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #fbfbfb;width:100%' cellpadding='0' cellspacing='0'>
  <tbody>
  <tr style='vertical-align: top'>
    <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td align='center' style='background-color: #fbfbfb;'><![endif]-->
    

<div class='u-row-container' style='padding: 0px;background-image: url('images/image-5.png');background-repeat: no-repeat;background-position: center top;background-color: transparent'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;'>
    <div style='border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;'>
      <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-image: url('images/image-5.png');background-repeat: no-repeat;background-position: center top;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: transparent;'><![endif]-->
      
<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
  <div style='height: 100%;width: 100% !important;'>
  <!--[if (!mso)&(!IE)]><!--><div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
  
<table id='u_content_image_2' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:30px 10px 8px;font-family:'Montserrat',sans-serif;' align='left'>
        
<table width='100%' cellpadding='0' cellspacing='0' border='0'>
  <tr>
    <td class='v-text-align' style='padding-right: 0px;padding-left: 0px;' align='center'>
      
      <img align='center' border='0' src='https://www.zupimages.net/up/22/49/kwkl.png' alt='Logo Alizon' title='image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 20%;max-width: 116px;' width='116' class='v-src-width v-src-max-width'/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_heading_1' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px 60px 0px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <h1 class='v-text-align v-font-size' style='margin: 0px; line-height: 120%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: 'Rubik',sans-serif; font-size: 35px;'>Bienvenue sur Alizon !</h1>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_2' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px 100px 0px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div class='v-text-align' style='line-height: 140%; text-align: center; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'>Bonjour, nous vous souhaitons la bienvenue sur notre site internet. Votre compte a bien été créé et vous pouvez désormais vous connecter.</p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_3' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:5px 100px 10px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div class='v-text-align' style='line-height: 140%; text-align: center; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'>Pour toutes questions n'hésitez pas à contacter notre support à support@alizon.fr</p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_button_1' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px 10px 60px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->
<div class='v-text-align' align='center'>
  <!--[if mso]><v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='https://www.unlayer.com' style='height:37px; v-text-anchor:middle; width:174px;' arcsize='11%'  stroke='f' fillcolor='#000000'><w:anchorlock/><center style='color:#FFFFFF;font-family:'Montserrat',sans-serif;'><![endif]-->  
    <a href='https://www.unlayer.com' target='_blank' class='v-button v-size-width' style='box-sizing: border-box;display: inline-block;font-family:'Montserrat',sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #000000; border-radius: 4px;-webkit-border-radius: 4px; -moz-border-radius: 4px; width:30%; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;'>
      <span style='display:block;padding:10px 20px;line-height:120%;'>Connexion</span>
    </a>
  <!--[if mso]></center></v:roundrect><![endif]-->
</div>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: transparent'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;'>
    <div style='border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;'>
      <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: transparent;'><![endif]-->
      
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
  <div style='height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  <!--[if (!mso)&(!IE)]><!--><div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'><!--<![endif]-->
  
<table id='u_content_image_3' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:60px 10px;font-family:'Montserrat',sans-serif;' align='left'>
        
<table width='100%' cellpadding='0' cellspacing='0' border='0'>
  <tr>
    <td class='v-text-align' style='padding-right: 0px;padding-left: 0px;' align='center'>
      
      <img align='center' border='0' src='https://upload.wikimedia.org/wikipedia/fr/b/bb/Produit_en_Bretagne_logo.png' alt='image' title='image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 73%;max-width: 204.4px;' width='204.4' class='v-src-width v-src-max-width'/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
  <div style='height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  <!--[if (!mso)&(!IE)]><!--><div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'><!--<![endif]-->
  
<table id='u_content_heading_3' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:65px 10px 0px 30px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <h1 class='v-text-align v-font-size' style='margin: 0px; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: 'Rubik',sans-serif; font-size: 22px;'><div>
<div>
<div>
<div>
<div>Produit locaux</div>
</div>
</div>
</div>
</div></h1>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_1' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:5px 10px 10px 30px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div class='v-text-align' style='line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'>Lorem ipsum dolor sit amet, consec tetur adip iscing elit, sed do eiusmod tempor incid idunt.</p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_button_2' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px 10px 10px 30px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->
<div class='v-text-align' align='left'>
  <!--[if mso]><v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='https://www.unlayer.com' style='height:54px; v-text-anchor:middle; width:169px;' arcsize='7.5%'  stroke='f' fillcolor='#2d2d2d'><w:anchorlock/><center style='color:#FFFFFF;font-family:'Montserrat',sans-serif;'><![endif]-->  
    <a href='https://www.unlayer.com' target='_blank' class='v-button v-size-width' style='box-sizing: border-box;display: inline-block;font-family:'Montserrat',sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #2d2d2d; border-radius: 4px;-webkit-border-radius: 4px; -moz-border-radius: 4px; width:65%; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;'>
      <span style='display:block;padding:10px 20px;line-height:120%;'><strong><span style='font-size: 14px; line-height: 16.8px;'>Consulter les produits</span></strong></span>
    </a>
  <!--[if mso]></center></v:roundrect><![endif]-->
</div>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: transparent'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;'>
    <div style='border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;'>
      <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: transparent;'><![endif]-->
      
<!--[if (mso)|(IE)]><td align='center' width='300' style='background-color: #eaeaea;width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
  <div style='background-color: #eaeaea;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  <!--[if (!mso)&(!IE)]><!--><div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'><!--<![endif]-->
  
<table id='u_content_heading_4' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:60px 10px 0px 30px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <h1 class='v-text-align v-font-size' style='margin: 0px; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: 'Rubik',sans-serif; font-size: 22px;'><div>
<div>
<div>
<div>
<div>Paiement sécurisé</div>
</div>
</div>
</div>
</div></h1>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_4' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:5px 10px 10px 30px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div class='v-text-align' style='line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'>Nous utilisons PayPal comme solution de paiement sécurisé.</p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_button_3' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px 10px 10px 30px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->
<div class='v-text-align' align='left'>
  <!--[if mso]><v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='https://www.unlayer.com' style='height:37px; v-text-anchor:middle; width:169px;' arcsize='11%'  stroke='f' fillcolor='#2d2d2d'><w:anchorlock/><center style='color:#FFFFFF;font-family:'Montserrat',sans-serif;'><![endif]-->  

  <!--[if mso]></center></v:roundrect><![endif]-->
</div>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
<!--[if (mso)|(IE)]><td align='center' width='300' style='background-color: #eaeaea;width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
  <div style='background-color: #eaeaea;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  <!--[if (!mso)&(!IE)]><!--><div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'><!--<![endif]-->
  
<table id='u_content_image_4' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:60px 10px;font-family:'Montserrat',sans-serif;' align='left'>
        
<table width='100%' cellpadding='0' cellspacing='0' border='0'>
  <tr>
    <td class='v-text-align' style='padding-right: 0px;padding-left: 0px;' align='center'>
      
      <img align='center' border='0' src='https://www.zupimages.net/up/22/49/043z.png' alt='image' title='image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 85%;max-width: 238px;' width='238' class='v-src-width v-src-max-width'/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: transparent'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;'>
    <div style='border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;'>
      <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: transparent;'><![endif]-->
      
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
  <div style='height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  <!--[if (!mso)&(!IE)]><!--><div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'><!--<![endif]-->
  
<table id='u_content_image_5' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:60px 10px;font-family:'Montserrat',sans-serif;' align='left'>
        
<table width='100%' cellpadding='0' cellspacing='0' border='0'>
  <tr>
    <td class='v-text-align' style='padding-right: 0px;padding-left: 0px;' align='center'>
      
      <img align='center' border='0' src='https://www.zupimages.net/up/22/49/w54i.png' alt='image' title='image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 73%;max-width: 204.4px;' width='204.4' class='v-src-width v-src-max-width'/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
  <div style='height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  <!--[if (!mso)&(!IE)]><!--><div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'><!--<![endif]-->
  
<table id='u_content_heading_5' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:65px 10px 0px 30px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <h1 class='v-text-align v-font-size' style='margin: 0px; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: 'Rubik',sans-serif; font-size: 22px;'>Livraison dans toute la France métropolitaine</h1>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_5' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:5px 10px 10px 30px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div class='v-text-align' style='line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'>Avec nos partenaires, nous vous proposons la livraison partout en France.</p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_button_4' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px 10px 10px 30px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->
<div class='v-text-align' align='left'>
  <!--[if mso]><v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='https://www.unlayer.com' style='height:37px; v-text-anchor:middle; width:169px;' arcsize='11%'  stroke='f' fillcolor='#2d2d2d'><w:anchorlock/><center style='color:#FFFFFF;font-family:'Montserrat',sans-serif;'><![endif]-->  

  <!--[if mso]></center></v:roundrect><![endif]-->
</div>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: transparent'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;'>
    <div style='border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;'>
      <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: transparent;'><![endif]-->
      
<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;' valign='top'><![endif]-->
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
  <div style='height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  <!--[if (!mso)&(!IE)]><!--><div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'><!--<![endif]-->
  
<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='81%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 2px solid #2d2d2d;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
    <tbody>
      <tr style='vertical-align: top'>
        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_12' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px 100px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div class='v-text-align' style='line-height: 160%; text-align: center; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 160%;'>Alizon est une marque déposée par CORBREC SA au capital social de 12300€.</p>
<p style='font-size: 14px; line-height: 160%;'> </p>
<p style='font-size: 14px; line-height: 160%;'>contact@alizon.fr</p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px 10px 60px;font-family:'Montserrat',sans-serif;' align='left'>
        
<div align='center'>
  <div style='display: table; max-width:187px;'>
  <!--[if (mso)|(IE)]><table width='187' cellpadding='0' cellspacing='0' border='0'><tr><td style='border-collapse:collapse;' align='center'><table width='100%' cellpadding='0' cellspacing='0' border='0' style='border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:187px;'><tr><![endif]-->
  
    <!--[if (mso)|(IE)]></td><![endif]-->
    
    
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>


    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    </td>
  </tr>
  </tbody>
  </table>
  <!--[if mso]></div><![endif]-->
  <!--[if IE]></div><![endif]-->
</body>

</html>
";
if (mail($destinataire, $objet, $message, $headers)) // Envoi du message
{
    echo 'Votre message a bien été envoyé ';
}
else // Non envoyé
{
    echo "Votre message n'a pas pu être envoyé";
}
?>