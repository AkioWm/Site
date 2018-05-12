<?php
session_start();
require 'functions.php';
include 'head.php';

if(isConnected()){
  header('Location: home.php');
}

?>

<body>
  <div class="connexion">
    <form action="connexionverif.php" method="post">
      <?php

      if(isset($_SESSION['Error'])){ // Si $_SESSION est vide;
        echo $_SESSION['Error'];
      }

      if(isset($_SESSION['Error_empty'])){ // Si $_SESSION est vide;
        echo $_SESSION['Error_empty'];
      }

      ?>
      <h3>Pseudo: </h3>
      <input type="text" name="Pseudo" placeholder="Pseudo" required>
      <h3>Mot de passe: </h3>
      <input type="password" name="Mdp" placeholder="Mot De Passe" required>
      <button type="Submit" name="connexion">Connexion</button>
    </form>
    <?php
    unset($_SESSION['Error']);
    unset($_SESSION['Error_empty']);
    ?>
  </div>
</body>
</html>
 
