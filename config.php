<?php 
    try 
    {
        $bdd = new PDO("mysql:host=localhost;dbname=phpticket;charset=utf8", "root", "root");
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }
/*Utilise la fonciton PDO pour avoir  acces à la base de donnée, Nathan modifie les informations avec tes logs a toi
la fonction s'articule comme ceci: PDO("mysql:host=localhost (si tu es en local avec WAMP); 
dbname=nom de ta bdd);charset=uft8,"username de ta bdd","password de ta bdd");
*/
