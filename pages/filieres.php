<?php
require_once ('maSession.php');

require_once("connexiondb.php");
//RECUPERATION DES DONNEES DU FORMULAIRE POUR LA RECHERCHE
/*
  if(isset($_GET['nomF']))
  $nomf=$_GET['nomF'];
  else
  $nom="";
 */
//PAGINATION
$nom = isset($_GET['nomF']) ? $_GET['nomF'] : "";
$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : "all";

$size = isset($_GET['size']) ? $_GET['size'] : 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;
//FIN PAGINATION
if ($niveau == "all") {
    $requete = "select * from filieres
                where nomFiliere like '%$nom%'
                limit $size
                offset $offset";

    $requeteCount = "select count(*) countF from filieres
                    where nomFiliere like '%$nom%'";
} else {
    $requete = "select * from filieres
                where nomFiliere like '%$nom%'
                and niveau='$niveau' 
                limit $size
                offset $offset";
    //$resultats=$pdo->Query($requete);
    $requeteCount = "select count(*) countF from filieres
                where nomFiliere like '%$nom%'
                and niveau='$niveau'";
}
$resultats = $pdo->Query($requete);
$resultatsCount = $pdo->Query($requeteCount);
$tabCount = $resultatsCount->fetch();
$nbreFiliere = $tabCount['countF'];

$reste = $nbreFiliere % $size;

if ($reste == 0)
    $nombrepage = $nbreFiliere / $size;
else
    $nombrepage = floor($nbreFiliere / $size) + 1;
?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion des Filières</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
<?php include("menu.php");
?>
        <div class="container">
            <div class="panel panel-success margetop">
                <div class="panel-heading">Rechercher des filieres...</div>
                <div class="panel-body">
                    <form method="get" action="filieres.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nomF" placeholder="Tapez le nom de la filière" 
                                   class="form-control"
                                   value="<?php echo $nom ?>">
                        </div>
                        <label for="niveau">Niveau :</label> 
                        <select name="niveau" id="niveau" class="form-control" 
                                onchange="this.form.submit()">
                            <option value="all" <?php if ($niveau === "all") echo "selected" ?>>Tous les niveau</option>
                            <option value="m"   <?php if ($niveau === "m") echo "selected" ?>>Master</option>
                            <option value="l"   <?php if ($niveau === "l") echo "selected" ?>>Licence</option>
                            <option value="ts"  <?php if ($niveau === "ts") echo "selected" ?>>Technicien specialisé</option>
                            <option value="t"   <?php if ($niveau === "t") echo "selected" ?>>Technicien</option>
                            <option value="q"   <?php if ($niveau === "q") echo "selected" ?>>Qualification</option>
                        </select>

                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button>
                        &nbsp &nbsp
                        <?php if($_SESSION['user']['role']=='ADMIN'){ ?>
                        <a href="nouvellefiliere.php"><span class="glyphicon glyphicon-plus"></span>
                            Nouvelle filière
                        </a> 
                        <?php }?>
                    </form>
                </div>

            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Liste des filières (<?php echo $nbreFiliere ?> Filières)  </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id Filieres</th><th>Nom Filieres</th><th>Niveau</th>
                                 <?php if($_SESSION['user']['role']=='ADMIN'){ ?>
                                     <th>Actions</th>
                                 <?php } ?>
                            </tr>
                        </thead>

                        <tbody>

<?php while ($filier = $resultats->fetch()) { ?>
                                <tr>
                                    <td><?php echo $filier['idfilieres'] ?></td>
                                    <td><?php echo $filier['nomFiliere'] ?></td>
                                    <td><?php echo $filier['niveau'] ?></td>
                                     <?php if($_SESSION['user']['role']=='ADMIN'){ ?>
                                    <td>
                                        <a href="editerfiliere.php?idf=<?php echo $filier['idfilieres'] ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        &nbsp;
                                        <a onclick="return confirm('Voulez-vous vraiment supprimer la filiere ?')"
                                           href="supprimerfiliere.php?idf=<?php echo $filier['idfilieres'] ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>
                                    <?php } ?>
                                </tr>
<?php } ?>



                        </tbody>

                    </table>

                    <div>
                        <ul class="pagination">
<?php for ($i = 1; $i <= $nombrepage; $i++) { ?>
                                <li class="<?php if ($i == $page) echo 'active' ?>">
                                    <a href="filieres.php?page=<?php echo $i; ?>&nom=<?php echo $nomf ?>&niveau=<?php echo $niveau ?>">
                                <?php echo $i; ?>
                                    </a>
                                </li> 
                                    <?php } ?>                                            
                        </ul>
                    </div>

                </div>

            </div>
        </div>

    </body>
</html>