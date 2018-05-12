<?php

session_start();
require "functions.php";
include 'head.php';

if(isConnected()){
  header('Location: home.php');
}

$error = false;
$pseudo = htmlspecialchars($_POST['Pseudo']);
$email = $_POST['Email'];
$mdp = htmlspecialchars($_POST['Mdp']);
$rmdp = htmlspecialchars($_POST['Rmdp']);
// Au cas où le require serait enlevé

if(empty($pseudo) || empty($email) || empty($mdp) || empty($rmdp)){
  $_SESSION['Error_empty'] = '<h4 class ="red">Vous devez remplir tout les champs, veuillez réessayer</h4>';
  header('Location: register.php');
  $error = true;
}
if(strlen($pseudo)<6||strlen($pseudo)>15){
  $_SESSION['Error_pseudo1'] = '<h4 class ="red">Pseudo incorrect, veuillez réessayer</h4>';
  header('Location: register.php');
  $error = true;
}
if(strlen($mdp)<6){
  $_SESSION['Error_password']='<h4 class="red">Mot de passe incorrect, il doit contenir plus de 6 charactère. Veuillez réessayer</h4>';
  header('Location: register.php');
  $error = true;
}

if($mdp != $rmdp){
  $_SESSION['Error_rpassword'] ='<h4 class="red">Mot de passe retapez incorrect, veuillez réessayer</h4>';
  header('Location: register.php');
  $error = true;
}


$connection = connectionDB();

$req = $connection->prepare('SELECT COUNT(*) Pseudo FROM utilisateur WHERE pseudo=?');
$req->execute(array($pseudo));
$pseudo_valid = ($req->fetchColumn()==0)?0:1;

if($pseudo_valid==1){
  $_SESSION['Error_pseudo2'] = "<h4 class='red'>Pseudo déjà utilisé, veuillez réessayer</h4>";
  header('Location: register.php');
  $error = true;
}

if($error == true){
exit;
}

$mdp = password_hash($_POST['Mdp'], PASSWORD_DEFAULT); //chiffrement du mot de passe

$req = $connection->prepare('INSERT INTO utilisateur(Email,Pseudo,Password) VALUES(?,?,?)');
$req->execute(array($email,$pseudo,$mdp));


echo '<h2 class= "inscriptionVerif">Enregistrez avec succès</h2>';
echo '<a href="index.php" class="inscriptionVerif">Revenir a la page d\'acceuil</a>';

?>
