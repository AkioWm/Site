<?php
session_start();
include "head.php";
include 'functions.php';

if(isConnected()){
  header('Location: home.php');
}

$pseudo = htmlspecialchars($_POST['Pseudo']);
$mdp = $_POST['Mdp'];

if(empty($pseudo) || empty($mdp)){
  $_SESSION['Error_empty'] = '<h4 class="red">Vous devez remplir tout les champs, veuillez réessayer</h4>';
  header('Location: connexion.php');
}

$connection = connectionDB();

$query = $connection->prepare('SELECT id,Pseudo,Password,Email FROM utilisateur WHERE Pseudo=?');
$query->execute(array($pseudo));

$data = $query->fetch();
if(password_verify($mdp,$data['Password'])){
  $_SESSION['Pseudo'] = $data['Pseudo'];
  $_SESSION['Email'] = $data['Email'];
  $_SESSION['id'] = $data['id'];
  $_SESSION['Password'] = $data['Password'];
  $_SESSION['auth'] = true;
  echo '<h2 class= "connexionVerif">Bienvenue '.$_SESSION['Pseudo'].' !</h2> ';
  echo '<a href="home.php" class="connexionVerif">Acceder la page d\'acceuil</a>';
}else{
  $_SESSION['Error']='<h4 class= "red">Erreur Mot de passe ou pseudo incorrect</h4>';
  header('Location: connexion.php');
}

?>

