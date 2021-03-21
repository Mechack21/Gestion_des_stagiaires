<?php
require_once ('maSession.php');
require_once('connexiondb.php');
$idS = isset($_GET['idS']) ? $_GET['idS'] : 0;
$requete = "select * from stagiaires where idstagiaire=$idS";
$resultat = $pdo->Query($requete);
$stagiaire = $resultat->fetch();
$nomS = $stagiaire['nom'];
$prenom = $stagiaire['prenom'];
$civilite = $stagiaire['civilite'];
$photo = $stagiaire['photo'];
$idF = $stagiaire['idfilieres'];

$requeteF = "select * from filieres";
$resultatF = $pdo->Query($requeteF);
?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Editez les informations du Stagiaire</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");
        ?>
        <div class="container">
            <div class="panel panel-primary margetop">
                <div class="panel-heading">Editez le Stagiaire</div>
                <div class="panel-body" >
                    <form method="post" action="updatestagiaire.php" class="form" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="idS">Id du Stagiaire : <?php echo $idS ?></label>
                            <input type="hidden" name="idS" class="form-control"
                                   value="<?php echo $idS ?>">
                        </div>

                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $nomS ?>">
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prenom :</label>
                            <input type="text" name="prenom" class="form-control" value="<?php echo $prenom ?>">
                        </div>

                        <div class="form-group">
                            <label for="civilite">Civilité :</label>
                            <div class="radio">
                                <label><input type="radio" name="civilite" value="F"
                                              <?php if ($civilite === "F") echo 'checked'; ?>>F</label><br>
                                <label><input type="radio" name="civilite" value="M"
                                              <?php if ($civilite === "M") echo 'checked'; ?>> M </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="filiere">Filiere :</label> 
                            <select name="filiere" id="filiere" class="form-control"> 
                                <?php while ($fil = $resultatF->fetch()) { ?>
                                    <option value="<?php echo $fil['idfilieres']; ?>" <?php if ($idF === $fil['idfilieres']) echo 'selected'; ?>> 
                                        <?php echo $fil['nomFiliere']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="photo">Photo :</label>
                            <input type="file" name="photo" >
                        </div>

                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrez
                        </button>

                    </form>

                </div>

            </div>
        </div>

    </body>
</html>