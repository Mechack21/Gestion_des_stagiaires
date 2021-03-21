<?php
require_once ('maSession.php');
require_once('connexiondb.php');
$idf = isset($_GET['idf']) ? $_GET['idf'] : 0;
$requete = "select * from filieres where idfilieres=$idf";
$resultat = $pdo->Query($requete);
$filiere = $resultat->fetch();
$nomf = $filiere['nomFiliere'];
$niveau = strtolower($filiere['niveau']);
?>


<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Editez la  filiere</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");
        ?>
        <div class="container">
            <div class="panel panel-primary margetop">
                <div class="panel-heading">Editez la filière</div>
                    <div class="panel-body" >
                    <form method="post" action="updatefiliere.php" class="form">

                        <div class="form-group">
                            <label for="idF">Id de la filière : <?php echo $idf ?></label>
                            <input type="hidden" name="idf" class="form-control"
                                   value="<?php echo $idf ?>">
                        </div>

                        <div class="form-group">
                            <label for="niveau">Nom de la filière :</label>
                            <input type="text" name="nomf" placeholder="Tapez le nom de la filière" 
                                   class="form-control" value="<?php echo $nomf ?>">
                        </div>
                        <div class="form-group">
                            <label for="niveau">Niveau :</label> 
                            <select name="niveau" id="niveau" class="form-control"> 

                                <option value="m" <?php if ($niveau == "m") echo "selected" ?>>Master</option>
                                <option value="l" <?php if ($niveau == "l") echo "selected" ?> >Licence</option>
                                <option value="ts" <?php if ($niveau == "ts") echo "selected" ?> >Technicien specialisé</option>
                                <option value="t" <?php if ($niveau == "t") echo "selected" ?> >Technicien</option>
                                <option value="q" <?php if ($niveau == "q") echo "selected" ?> >Qualification</option>
                            </select>
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