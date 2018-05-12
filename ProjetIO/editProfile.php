<?php
session_start();
include 'head.php';
require 'functions.php';
if (!isConnected()){
  header('Location: index.php');
}
?>
<body>
  <div class="editProfile">

    <form action="editVerif.php" method="post">
      <h3>Email: </h3>     <!-- utilisation de label possible -->
      <input type="email" name="newEmail" placeholder="<?php echo $_SESSION['Email'];  ?>">
      <?php
      if(isset($_SESSION['Error_mail'])){
        echo $_SESSION['Error_mail'];
      }
       ?>
      <h3>Pseudo: </h3>
      <input type="text" name="newPseudo" placeholder="<?php echo $_SESSION['Pseudo'];  ?>">
      <?php
      if(isset($_SESSION['Error_pseudo1'])){
        echo $_SESSION['Error_pseudo1'];
      }
      if(isset($_SESSION['Error_pseudo2'])){
        echo $_SESSION['Error_pseudo2'];
      }
      if(isset($_SESSION['Error_pseudo3'])){
        echo $_SESSION['Error_pseudo3'];
      }
      ?>
      <h3>Mot de passe: </h3>
      <input type="password" name="newPassword" placeholder="Nouveau mot de passe">
      <input type="password" name="newRpassword" placeholder="Retapez votre mot de passe">
      <?php
      if(isset($_SESSION['Error_password'])){ // Si $_SESSION est vide;
        echo $_SESSION['Error_password'];
      }
      if(isset($_SESSION['Error_rpassword'])){ // Si $_SESSION est vide;
        echo $_SESSION['Error_rpassword'];
      }
      ?>
      <input type="submit" name="button" value="Mise à jour">

    </form>
  </div>
</body>
<?php
unset($_SESSION['Error_password']);
unset($_SESSION['Error_rpassword']);
unset($_SESSION['Error_pseudo1']);
unset($_SESSION['Error_empty']);
unset($_SESSION['Error_pseudo2']);
unset($_SESSION['Error_pseudo3']);
unset($_SESSION['Error_mail']);
?>
