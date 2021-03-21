<?php

session_start();
if (isset($_SESSION['user'])) {
    require_once("connexiondb.php");

    $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
    $civilite = isset($_POST['civilite']) ? $_POST['civilite'] : "";
    $idfiliere = isset($_POST['filiere']) ? $_POST['filiere'] : "";
    $photo = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : "";

    $imageTemp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp, "../images/" . $photo);


    $requete = "insert into stagiaires (nom,prenom,civilite,photo,idfilieres) values(?,?,?,?,?)";
    $params = array($nom, $prenom, $civilite, $photo, $idfiliere);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header('location:stagiaires.php');
   
}else{
     header('location:login.php');
}

