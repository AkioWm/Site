<?php

function connectionDB(){

  try
  {
    $bdd = new PDO('mysql:host=localhost;dbname=projectio2;charset=utf8', 'root', '');
  }
  catch (Exception $e)
  {
    die('Erreur : ' . $e->getMessage());
  }
  return $bdd;

}

function isConnected(){

  if(isset($_SESSION['auth'])){
    return true;
  }
  return false;
}

?>
 
