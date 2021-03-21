<?php

session_start();
if (isset($_SESSION['user'])) {
    require_once("connexiondb.php");

    $idS = isset($_POST['idS']) ? $_POST['idS'] : 0;
    $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
    $civilite = isset($_POST['civilite']) ? $_POST['civilite'] : "";
    $idfiliere = isset($_POST['filiere']) ? $_POST['filiere'] : "";
    $photo = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : "";

    $imageTemp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp, "../images/" . $photo);

    if (!empty($photo)) {
        $requete = "update stagiaires set nom=?, prenom=?, civilite=?, photo=?, idfilieres=? where idstagiaire=?";
        $params = array($nom, $prenom, $civilite, $photo, $idfiliere, $idS);
    } else {
        $requete = "update stagiaires set nom=?, prenom=?, civilite=?, idfilieres=? where idstagiaire=?";
        $params = array($nom, $prenom, $civilite, $idfiliere, $idS);
    }


    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
} else {
    header('location:login.php');
}



header('location:stagiaires.php');
