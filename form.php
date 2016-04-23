<?php

$delator;$name;$message;$captcha;$picture;$resp = array();
if(isset($_POST['name'])){
  $name=$_POST['name'];
}if(isset($_POST['message'])){
  $message=$_POST['message'];
}if(isset($_POST['delator'])){
  $delator=$_POST['delator'];
}if(isset($_POST['g-recaptcha-response'])){
  $captcha=$_POST['g-recaptcha-response'];
}if(isset($_POST['picture'])){
  $picture=$_POST['picture'];
}
if(!$name || !$message || !$captcha || !$delator){
  $resp['valid'] = FALSE;
  $resp['message'] = 'On ne pourras pas mettre la main sur ceux que tu dénonces si tu ne remplis pas correctement le formulaire.';
  echo json_encode($resp);
  die();
}
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LejcAgTAAAAAJ_euj1H-DuEsJ9FwiMGNN33J_qw&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
if($response.success==false)
{
  $resp['valid'] = FALSE;
  $resp['message'] = 'On ne pourras pas mettre la main sur ceux que tu dénonces si tu ne remplis pas correctement le formulaire.';
}else
{
  $resp['valid'] = TRUE;
  $resp['message'] = 'Le mur de la délation vient de s\'étoffer.';
}

echo json_encode($resp);