<?php
session_start();
include 'head.php';
require 'functions.php';
if (!isConnected()){
  header('Location: index.php');
}
?>
<header>
    <a href="editProfile" style="font-size:25px; text-align:right;">Modifier mon profil</a>
</header>
<div class="profil">

  <h4 class='white'>Pseudo: <?php echo $_SESSION['Pseudo']; ?></h4>
  <h4 class='white'>Email: <?php echo $_SESSION['Email'] ?></h4>




</div>
