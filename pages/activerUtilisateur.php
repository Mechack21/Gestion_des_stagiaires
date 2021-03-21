<?php

session_start();
if (isset($_SESSION['user'])) {
    require_once("connexiondb.php");

    $idU = isset($_GET['idU']) ? $_GET['idU'] : 0;
    $etat = isset($_GET['etat']) ? $_GET['etat'] : 0;
//var_dump($etat); die();

    if ($etat == 1) {
        $newEtat = 0;
    } else {
        $newEtat = 1;
    }

    $requete = "update utilisateurs set etat=? where idutilisateur=?";
    $params = array($newEtat, $idU);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header('location:utilisateurs.php');
} else {
    header('location:login.php');
}

