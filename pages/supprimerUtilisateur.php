<?php

session_start();
if (isset($_SESSION['user'])) {
    require_once("connexiondb.php");

    $idU = isset($_GET['idU']) ? $_GET['idU'] : 0;
    $requete = "delete from utilisateurs where idutilisateur=?";
    $params = array($idU);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header('location:utilisateurs.php');
} else {
    header('location:login.php');
}
?>