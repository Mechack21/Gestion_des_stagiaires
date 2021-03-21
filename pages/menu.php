<?php 
require_once ('maSession.php');
?>
<nav class="navbar navbar-inverse navbar-fixed-top" >
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="../index.php" class="navbar-brand"> Gestion des Stagiaires</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="stagiaires.php">Les Stagiaires</a></li>
            <li><a href="filieres.php">Les Filieres</a></li>
            <?php if($_SESSION['user']['role']=='ADMIN'){ ?>
            <li><a href="utilisateurs.php">Les Utilisateurs</a></li>
            <?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><i class="glyphicon glyphicon-user"></i><?php echo ' '. $_SESSION['user']['login'] ?></a></li>
            <li><a href="login.php"><i class="glyphicon glyphicon-log-out"></i>&nbsp; Se déconnecter</a></li>
        </ul>
    </div>
</nav>

