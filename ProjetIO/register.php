<?php

session_start();
include 'head.php';
require 'functions.php';
if(isConnected()){
  header('Location: home.php');
}
?>

<body>
  <div class="inscription">

    <form action="registerverif.php" method="post">
      <?php

      if(isset($_SESSION['Error_empty'])){ // Si $_SESSION est vide;
        echo $_SESSION['Error_empty'];
      }
       ?>
      <h3>Email: </h3>
      <input type="email" name="Email" placeholder="ex: toto@gmail.fr">
      <h3>Pseudo: (entre 6 et 15 caractères) </h3>
      <input type="text" name="Pseudo" placeholder="Votre pseudo" required>
      <?php
      if(isset($_SESSION['Error_pseudo1'])){ // Si $_SESSION est vide;
        echo $_SESSION['Error_pseudo1'];
      }
      if(isset($_SESSION['Error_pseudo2'])){ // Si $_SESSION est vide;
        echo $_SESSION['Error_pseudo2'];
      }
      ?>
      <h3>Mot de passe: (min 6 caractères) </h3>
      <input type="password" name="Mdp" placeholder="Mot de Passe" required>
      <?php
      if(isset($_SESSION['Error_password'])){ // Si $_SESSION est vide;
        echo $_SESSION['Error_password'];
      }
      ?>
      <h3>Confirmation Mot de passe: </h3>
      <input type="Password" name="Rmdp" placeholder="Retapez votre mot de passe" required>
      <?php
      if(isset($_SESSION['Error_rpassword'])){ // Si $_SESSION est vide;
        echo $_SESSION['Error_rpassword'];
      }
      ?>
      <button type="submit" name="button">Enregistrez</button>

    </form>
    <?php unset($_SESSION['Error_password']);
          unset($_SESSION['Error_rpassword']);
          unset($_SESSION['Error_pseudo1']);
          unset($_SESSION['Error_empty']);
          unset($_SESSION['Error_pseudo2']);
     ?>
  </div>
</body>
</html>
