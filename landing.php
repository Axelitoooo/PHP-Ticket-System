<?php 
    session_start();
    require_once 'config.php';
    if(!isset($_SESSION['user'])){
        header('Location:pagecon.php');
        die();
    }
    // Cette page est la page de landing ou l'on arrive lors de la connexion donc c'esr la ou les tickets doivent apparaitre 
    // On récupere les données de l'utilisateur
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();
   
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Page de ticket</title>
    <h3> Salut juste </h3>
      
  </head>
  