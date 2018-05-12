<?php

session_start();
require "../functions.php";

if (count($_POST) === 5
  && !empty($_POST["firstName"])
  && !empty($_POST["lastName"])
  && !empty($_POST["email"])
  && !empty($_POST["pwd"])
  && !empty($_POST["pwdConfirm"])
) {
  $error = false;

  $_POST["firstName"] = ucfirst(strtolower(trim($_POST["firstName"])));
  $_POST["lastName"]  = trim(strtoupper($_POST["lastName"]));
  $_POST["email"]     = trim(strtolower($_POST["email"]));

  if (strlen($_POST["firstName"]) < 2 || strlen($_POST["firstName"]) > 20) {
    $error = true;
  }

  if (strlen($_POST["lastName"]) < 2 || strlen($_POST["lastName"]) > 20) {
    $error = true;
  }

  if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $error = true;
  }

  if (strlen($_POST["pwd"]) < 8 || strlen($_POST["pwd"]) > 60) {
    $error = true;
  }

  if ($_POST["pwd"] !== $_POST["pwdConfirm"]) {
    $error = true;
  }

  if ($error) {
    $_SESSION["postForm"] = $_POST;
    header("Location: ../signup.php");
  }

  // Else => insertion in database

  else {

    // Database connection
    $connection = connectDB();
    // Query that inserts the new member
    $query = $connection->prepare("INSERT INTO MEMBER (email,first_name,last_name,password) VALUES (?, ?, ?, ?)");

    $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

    // Execute the query
    $query->execute([
      $_POST["email"],
      $_POST["firstName"],
      $_POST["lastName"],
      $pwd
    ]);

    header("Location: ../home.php");
  }

} else {
  die("Erreur formulaire");
}
