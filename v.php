<?php
$utilisateur = 'admin';
$motdepasse = '0000';
$conecte = false;
$secret = md5($utilisateur.'-'.$motdepasse) ;




if (isset($_POST['utilisateur']) && isset($_POST['motdepass']) )  {
  if( $_POST['utilisateur']== $utilisateur && $_POST['motdepass'] == $motdepasse){
  setcookie("u", $secret, time()+(3600 * 24 * 7),"/", "", 0);
  $conecte = true;
}

}



if (isset($_GET['deconexion'])) {

   setcookie("u", null, time()- 120,"/", "", 0);
   $conecte = false;
   $secret=null;

}



if ((isset($_COOKIE['u']) && $_COOKIE['u'] == $secret) || $conecte) {


} else {
  include 'connexion.php';
  die();
}




 ?>
