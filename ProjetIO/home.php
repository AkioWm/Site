<?php
session_start();
require 'functions.php';
if (!isConnected()){
  header('Location: index.php');
}
include 'head.php';

?>

<header>
  <h4 class='white left'style="display:inline;font-size:25px"> <?php echo $_SESSION['Pseudo']; ?></h4>
  <nav>
    <a href="createPost.php">Créé un poste</a>
    <a href="profil.php">Mon profil</a>
    <a href="logout.php">Deconnexion</a>
  </nav>
</header>
