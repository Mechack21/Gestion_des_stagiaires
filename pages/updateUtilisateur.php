<?php

session_start();
if (isset($_SESSION['user'])) {
    require_once("connexiondb.php");

    $idU = isset($_POST['idU']) ? $_POST['idU'] : 0;
    $login = isset($_POST['login']) ? $_POST['login'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $role = isset($_POST['role']) ? $_POST['role'] : "";

    $requete = "update utilisateurs set login=?, email=?, role=? where idutilisateur=?";
    $params = array($login, $email, $role, $idU);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    header('location:utilisateurs.php');
} else {

    header('location:login.php');
}

