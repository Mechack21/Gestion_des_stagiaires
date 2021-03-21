<?php
require_once ('maSession.php');
require_once('connexiondb.php');

$requeteF = "select * from filieres";
$resultatF = $pdo->Query($requeteF);
?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouveau Stagiaire</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");
        ?>
        <div class="container">
            <div class="panel panel-primary margetop">
                <div class="panel-heading">Saisie des informations du Stagiaire</div>
                <div class="panel-body" >
                    <form method="post" action="insertstagiaire.php" class="form" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" class="form-control" placeholder="Nom">
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prenom :</label>
                            <input type="text" name="prenom" class="form-control" placeholder="Prenom"">
                        </div>

                        <div class="form-group">
                            <label for="civilite">Civilité :</label>
                            <div class="radio">
                                <label><input type="radio" name="civilite" value="F" checked>F</label><br>
                                <label><input type="radio" name="civilite" value="M" > M </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="filiere">Filiere :</label> 
                            <select name="filiere" id="filiere" class="form-control"> 
                                <?php while ($fil = $resultatF->fetch()) { ?>
                                    <option value="<?php echo $fil['idfilieres']; ?>"> 
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