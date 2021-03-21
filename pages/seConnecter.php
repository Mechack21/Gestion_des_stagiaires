<?php

session_start();
require_once('connexiondb.php');
$login = isset($_POST['login']) ? $_POST['login'] : "";
$password = isset($_POST['pwd']) ? $_POST['pwd'] : "";


$requete = "select * from utilisateurs where login='$login' and psswd=MD5('$password')";
$resultat = $pdo->query($requete);

if ($user = $resultat->fetch()) {
//    var_dump($user); die();
    if ($user['etat'] == 1) {
        $_SESSION['user'] = $user;
//        var_dump($_SESSION['user']); die();
        header('Location:../index.php');
    } else {
        $_SESSION['erreurLogin'] = "<strong>Erreur!</strong> Votre compte est desactivé.<br>Veuillez contactez l'administrateur pour l'activer";
        header('location:../index.php');
    }
}else{
    $_SESSION['erreurLogin'] = "<strong>Erreur!</strong> Login ou mot de passe incorrecte!!!";
        header('location:../index.php');
}
?>
