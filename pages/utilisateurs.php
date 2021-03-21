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
$login = isset($_GET['login']) ? $_GET['login'] : "";


$size = isset($_GET['size']) ? $_GET['size'] : 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;
//FIN PAGINATION




$requeteUser = "select * from utilisateurs where login like '%$login%' limit $size offset $offset";

$requeteCount = "select count(*) countU from utilisateurs";

$resultatUser = $pdo->Query($requeteUser);

$resultatsCount = $pdo->Query($requeteCount);

$tabCount = $resultatsCount->fetch();
$nbreUtilisateur = $tabCount['countU'];

$reste = $nbreUtilisateur % $size;

if ($reste == 0)
    $nombrepage = $nbreUtilisateur / $size;
else
    $nombrepage = floor($nbreUtilisateur / $size) + 1;
?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion des Utilisateurs</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
<?php include("menu.php");
?>
        <div class="container">
            <div class="panel panel-success margetop">
                <div class="panel-heading">Rechercher des utilisateurs...</div>
                <div class="panel-body">
                    <form method="get" action="utilisateurs.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="login" placeholder="Tapez le login" 
                                   class="form-control"
                                   value="<?php echo $login ?>">
                        </div>

                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button>
                        &nbsp &nbsp

                    </form>
                </div>

            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Liste des utilisateurs (<?php echo $nbreUtilisateur ?> Utilisateurs)  </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Login</th><th>E-mail</th><th>Role</th><th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

<?php while ($utilisateur = $resultatUser->fetch()) { ?>
                                <tr class="<?php if ($utilisateur['etat'] == 1) echo 'success';
    else echo 'danger'; ?>">
                                    <td><?php echo $utilisateur['login'] ?></td>
                                    <td><?php echo $utilisateur['email'] ?></td>
                                    <td><?php echo $utilisateur['role'] ?></td>

                                    <td>
                                        <a href="editerUtilisateur.php?idU=<?php echo $utilisateur['idutilisateur'] ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        &nbsp;
                                        <a onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')"
                                           href="supprimerUtilisateur.php?idU=<?php echo $utilisateur['idutilisateur'] ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>

                                        <a href="activerUtilisateur.php?idU=<?php echo $utilisateur['idutilisateur'] ?>&etat=<?php echo $utilisateur['etat'] ?>">
    <?php
    if ($utilisateur['etat'] == 1)
        echo '<span class="glyphicon glyphicon-remove"></span>';
    else
        echo '<span class="glyphicon glyphicon-ok"></span>';
    ?>
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
                                    <a href="utilisateurs.php?page=<?php echo $i; ?>&login=<?php echo $login ?>">
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