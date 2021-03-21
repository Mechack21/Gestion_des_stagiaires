<?php 

require_once ('maSession.php');

?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouvelle filiere</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");    
        ?>
        <div class="container">
            <div class="panel panel-primary margetop">
                    <div class="panel-heading">Veuillez saisir les données de la nouvelle filières</div>
                    <div class="panel-body" >
                        <form method="post" action="insertfilieres.php" class="form">
                                <div class="form-group">
                                    <label for="niveau">Nom de la filière :</label>
                                    <input type="text" name="nomF" placeholder="Tapez le nom de la filière" 
                                    class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="niveau">Niveau :</label> 
                                    <select name="niveau" id="niveau" class="form-control"> 
                                   
                                        <option value="m" selected>Master</option>
                                        <option value="l" >Licence</option>
                                        <option value="ts" >Technicien specialisé</option>
                                        <option value="t" >Technicien</option>
                                        <option value="q" >Qualification</option>
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