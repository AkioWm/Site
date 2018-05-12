<?php
session_start();
require 'functions.php';
include 'head.php';
$error = false;
$pseudo = htmlspecialchars($_POST['newPseudo']);
$email = htmlspecialchars($_POST['newEmail']);
$mdp = htmlspecialchars($_POST['newPassword']);
$rmdp = htmlspecialchars($_POST['newRpassword']);


$connection = connectionDB();
$req = $connection->prepare('SELECT COUNT(*) Pseudo FROM utilisateur WHERE pseudo=?');
$req->execute(array($pseudo));
$pseudo_valid = ($req->fetchColumn()==0)?0:1;




if(isset($pseudo) AND !empty($pseudo)){
  if(strlen($pseudo)<6||strlen($pseudo)>15){
    $_SESSION['Error_pseudo1'] = '<h4 class ="red">Pseudo incorrect, veuillez réessayer</h4>';
    header('Location: editProfile.php');
    $error = true;
  }elseif($pseudo_valid==1){
    $_SESSION['Error_pseudo2'] = "<h4 class='red'>Pseudo déjà utilisé, veuillez réessayer</h4>";
    header('Location: editProfile.php');
    $error = true;
  }elseif($pseudo == $_SESSION['Pseudo']){
    $_SESSION['Error_pseudo3'] = "<h4 class='red'>Erreur pseudo identique à l'ancien , veuillez réessayer</h4>";
    $error = true;
  }else{
    $insertPseudo = $connection->prepare('UPDATE utilisateur SET Pseudo=? WHERE Pseudo=?');
    $insertPseudo->execute(array($pseudo,$_SESSION['Pseudo']));
    $_SESSION['Pseudo'] = $pseudo;
    header('Location: profil.php');
  }
}

if(isset($email) AND !empty($email)){
  if($email == $_SESSION['Email']){
    $_SESSION['Error_mail'] = "<h4 class='red'>Erreur mail identique à l'ancien , veuillez réessayer</h4>";
    $error = true;
    header('Location: editProfile.php');
  }else{
    $insertEmail = $connection->prepare('UPDATE utilisateur SET Email=? WHERE Email =?');
    $insertEmail->execute(array($email,$_SESSION['Email']));
    $_SESSION['Email'] = $email;
    header('Location: profil.php');
  }
}


if (isset($mdp) AND !empty($mdp)){
  if(strlen($mdp)<6){
    $_SESSION['Error_password']='<h4 class="red">Mot de passe incorrect, il doit contenir plus de 6 charactère. Veuillez réessayer</h4>';
    header('Location: editProfile.php');
    $error = true;
  }elseif($mdp != $rmdp){
    $_SESSION['Error_rpassword'] ='<h4 class="red">Mot de passe retapez incorrect, veuillez réessayer</h4>';
    header('Location: editProfile.php');
    $error = true;
  }else{
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $insertMdp = $connection->prepare('UPDATE utilisateur SET Password=? WHERE Password=?');
    $insertMdp->execute(array($mdp,$_SESSION['Password']));
    $_SESSION['Password'] = $mdp;
    header('Location: profil.php');

  }
}
if($error == true){
  exit;
}
?>
