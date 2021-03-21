<?php

session_start();
if (isset($_SESSION['user'])) {
    require_once("connexiondb.php");

    $idf = isset($_POST['idf']) ? $_POST['idf'] : 0;
    $nomf = isset($_POST['nomf']) ? $_POST['nomf'] : "";
    $niveau = isset($_POST['niveau']) ? strtoupper($_POST['niveau']) : "";

    $requete = "update filieres set nomFiliere=?, niveau=? where idfilieres=?";
    $params = array($nomf, $niveau, $idf);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    header('location:filieres.php');
} else {
    header('location:login.php');
}
?>