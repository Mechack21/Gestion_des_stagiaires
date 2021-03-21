<?php
require_once ('maSession.php');
require_once('connexiondb.php');
$idU = isset($_GET['idU']) ? $_GET['idU'] : 0;
$requete = "select * from utilisateurs where idutilisateur=$idU";
$resultat = $pdo->Query($requete);
$Users = $resultat->fetch();

$login = $Users['login'];
$email= $Users['email'];
$role= $Users['role'];
//$etat = $Users['etat'];
//$idF = $stagiaire['idfilieres'];


?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edition de l'utilisateur</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");
        ?>
        <div class="container">
            <div class="panel panel-primary margetop">
                <div class="panel-heading">Editez les informations du Stagiaire</div>
                <div class="panel-body" >
                    <form method="post" action="updateUtilisateur.php" class="form">

                        <div class="form-group">
                            <label for="idU">Id de l'utilisateur : <?php echo $idU ?></label>
                            <input type="hidden" name="idU" class="form-control"
                                   value="<?php echo $idU ?>">
                        </div>

                        <div class="form-group">
                            <label for="nom">Login :</label>
                            <input type="text" name="login" class="form-control" value="<?php echo $login ?>">
                        </div>

                        <div class="form-group">
                            <label for="prenom">Email :</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="role">Role :</label>
                            <select name="role" class="form-control">
                                <option value="ADMIN" <?php if($role=="ADMIN") echo 'selected';  ?> >Administrateur</option>
                                <option value="VISITEUR" <?php if($role=="VISITEUR") echo 'selected';  ?> >Visiteur</option>
                            </select>
                        </div>
                    
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrez
                        </button>
                        &nbsp;&nbsp;
                        <a href="modifierpassword.php?idU=<?php echo $idU ;?>">Changer le mot de pass</a>

                    </form>

                </div>

            </div>
        </div>

    </body>
</html>