<?php
  session_start();

  require_once "functions.php";
  include "head.php";
?>

  <?php
    function fillSessionField($field) {
      return isset($_SESSION["postForm"]) ? $_SESSION["postForm"][$field] : "";
    }
  ?>
    <form action="script/saveUser.php" method="POST">
      <h1>S'incrire</h1>
      <input type="text" name="firstName" id="" value="<?php echo fillSessionField("firstName") ?>" placeholder="Prénom" required><br>
      <input type="text" name="lastName" id="" value="<?php echo fillSessionField("lastName") ?>" placeholder="Nom" required><br>
      <input type="email" name="email" id="" value="<?php echo fillSessionField("email") ?>" placeholder="email" required><br>
      <input type="password" name="pwd" id="" placeholder="Mot de passe" required><br>
      <input type="password" name="pwdConfirm" id="" placeholder="Confirmez" required><br><br>
      <input type="submit" value="Soumettre">
    </form>

    <?php
      unset($_SESSION["postForm"]);
    ?>

<?php
  include "footer.php";
?>
