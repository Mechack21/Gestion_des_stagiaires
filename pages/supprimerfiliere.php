<?php

session_start();
if (isset($_SESSION['user'])) {
    require_once("connexiondb.php");

    $idf = isset($_GET['idf']) ? $_GET['idf'] : 0;

    $requetestag = "select count(*) countstag from stagiaires where idfilieres=$idf";
    $resultatstag = $pdo->Query($requetestag);

    $tabstag = $resultatstag->fetch();
    $nbrestag = $tabstag['countstag'];

    if ($nbrestag == 0) {

        $requete = "delete from filieres where idfilieres=?";
        $params = array($idf);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:filieres.php');
    } else {
        $mesg = "Suppression impossible : Vous devez supprimer tout les stagiaires inscrits dans cette filiere";
        header("location:alert.php?message=$mesg");
    }
    
}else{
    header('location:login.php');
}
?>