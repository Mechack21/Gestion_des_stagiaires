<?php
require_once ('maSession.php');
require_once("connexiondb.php");
//RECUPERATION DES DONNEES DU FORMULAIRE POUR LA RECHERCHE
/*
  if(isset($_GET['nomprenom']))
  $nomprenom=$_GET['nomprenom'];
  else
  $nomprenom="";
 */
//PAGINATION $filiere
$nomprenom = isset($_GET['nomprenom']) ? $_GET['nomprenom'] : "";
$idfiliere = isset($_GET['idfiliere']) ? $_GET['idfiliere'] : 0;

$size = isset($_GET['size']) ? $_GET['size'] : 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;
//FIN PAGINATION

$requetrFiliere = "select * from filieres";

if ($idfiliere == 0) {
    $requeteS = "select idstagiaire, nom, prenom, civilite, photo, nomFiliere
               from filieres as F, stagiaires as S
                where F.idfilieres=S.idfilieres 
                and (nom like '%$nomprenom%' or prenom like '%$nomprenom%')
                order by idstagiaire
                limit $size
                offset $offset";

    $requeteCount = "select count(*) countS from stagiaires
                    where nom like '%$nomprenom%' or prenom like '%$nomprenom%'";
} else {
    $requeteS = "select idstagiaire, nom, prenom, civilite, photo, nomFiliere
                from filieres as F, stagiaires as S
                where F.idfilieres=S.idfilieres 
                and (nom like '%$nomprenom%' or prenom like '%$nomprenom%')
                and F.idfilieres=$idfiliere
                order by idstagiaire
                limit $size
                offset $offset";

    $requeteCount = "select count(*) countS from stagiaires
         where (nom like '%$nomprenom%' or prenom like '%$nomprenom%')
         and idfilieres=$idfiliere";
}
$resultat = $pdo->Query($requeteS);
$resultatF = $pdo->Query($requetrFiliere);
$resultatsCount = $pdo->Query($requeteCount);

$tabCount = $resultatsCount->fetch();
$nbreStagiaire = $tabCount['countS'];

$reste = $nbreStagiaire % $size;

if ($reste == 0)
    $nombrepage = $nbreStagiaire / $size;
else
    $nombrepage = floor($nbreStagiaire / $size) + 1;
?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion des Stagiaires</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
<?php include("menu.php");
?>
        <div class="container">
            <div class="panel panel-success margetop">
                <div class="panel-heading">Rechercher des stagiaires...</div>
                <div class="panel-body">
                    <form method="get" action="stagiaires.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nomprenom" placeholder="Tapez le nom et prenom du stagiaire" 
                                   class="form-control"
                                   value="<?php echo $nomprenom ?>">
                        </div>
                        <label for="idfiliere">Filières :</label> 
                        <select name="idfiliere" id="idfiliere" class="form-control" 
                                onchange="this.form.submit()">
                            <option value=0>Toutes les Filieres</option>
<?php while ($filiere = $resultatF->fetch()) { ?>
                                <option value="<?php echo $filiere['idfilieres'] ?>"
                                <?php if ($filiere['idfilieres'] === $idfiliere) echo "selected" ?>>
                                <?php echo $filiere['nomFiliere'] ?>
                                </option>
                                    <?php } ?>
                        </select>

                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button>
                        &nbsp &nbsp
                        <a href="nouveauStagiaire.php"><span class="glyphicon glyphicon-plus"></span>
                            Nouveau Stagiaires</a>                        
                    </form>
                </div>

            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Liste des stagiaires (<?php echo $nbreStagiaire ?> Stagiaires)  </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id Stagiaires</th><th>Nom</th><th>Prénom</th>
                                <th>Filieres</th><th>Photos</th><th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

<?php while ($stagiaire = $resultat->fetch()) { ?>
                                <tr>
                                    <td><?php echo $stagiaire['idstagiaire'] ?></td>
                                    <td><?php echo $stagiaire['nom'] ?></td>
                                    <td><?php echo $stagiaire['prenom'] ?></td>
                                    <td><?php echo $stagiaire['nomFiliere'] ?></td>
                                    <td>
                                        <img src="../images/<?php echo $stagiaire['photo'] ?>" 
                                             width="50px" height="50px" class="img-circle">
                                    </td>

                                    <td>
                                        <a href="editerStagiaire.php?idS=<?php echo $stagiaire['idstagiaire'] ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        &nbsp;
                                        <a onclick="return confirm('Voulez-vous vraiment supprimer le stagiaire ?')"
                                           href="supprimerStagiaire.php?idS=<?php echo $stagiaire['idstagiaire'] ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>
                                </tr>
<?php } ?>



                        </tbody>

                    </table>

                    <div>
                        <ul class="pagination">
<?php for ($i = 1; $i <= $nombrepage; $i++) { ?>
                                <li class="<?php if ($i == $page) echo 'active' ?>">
                                    <a href="stagiaires.php?page=<?php echo $i; ?>&nomprenom=<?php echo $nomprenom ?>&idfiliere=<?php echo $idfiliere ?>">
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